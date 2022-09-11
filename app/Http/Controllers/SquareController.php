<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderBreakDown;
use App\Models\OrderDetails;
use App\Models\User;
use Illuminate\Http\Request;

class SquareController extends Controller
{
    public function __construct()
    {
        // $accessToken = env('SQUARE_ACCESS_TOKEN', 'EAAAEA0Oy9027MEMUcIBer6UNmYpsgh069E9FMjaEZfGx48Jw2Ukbh-mfEFmMvPg');
        // $this->locationId = env('SQUARE_LOCATION_ID', '90XTYB26P4HAP');

        $accessToken = env('SQUARE_ACCESS_TOKEN', 'EAAAEGVSnLf7cHE3ZAzEFWW5oLnmVYsca831UHgj1dDP9gEuXbgDm6ay_DNRVshb');
        $this->locationId = env('SQUARE_LOCATION_ID', 'LT3S9VKS0T0N3');
        $defaultApiConfig = new \SquareConnect\Configuration();
        $defaultApiConfig->setSSLVerification(FALSE);
        $defaultApiConfig->setHost("https://connect.squareupsandbox.com");
        $defaultApiConfig->setAccessToken($accessToken);
        $this->defaultApiClient = new \SquareConnect\ApiClient($defaultApiConfig);
    }

    public function refund($paymentId)
    {
        $refundApi = new \SquareConnect\Api\RefundsApi($this->defaultApiClient);
        $body = new \SquareConnect\Model\RefundPaymentRequest(); // \SquareConnect\Model\RefundPaymentRequest | An object containing the fields to POST for the request.  See the corresponding object definition for field details.
        $amountMoney = new \SquareConnect\Model\Money();

        # Monetary amounts are specified in the smallest unit of the applicable currency.
        # This amount is in cents. It's also hard-coded for $1.00, which isn't very useful.
        $amountMoney->setAmount(100);
        $amountMoney->setCurrency("USD");

        $body->setPaymentId($paymentId);
        $body->setAmountMoney($amountMoney);
        $body->setIdempotencyKey(uniqid());
        $body->setReason('wrong order');
        try {
            $result = $refundApi->refundPayment($body);
            print_r($result);
        } catch (Exception $e) {
            echo 'Exception when calling RefundsApi->refundPayment: ', $e->getMessage(), PHP_EOL;
        }
    }

    public function addCustomer($name, $email)
    {

        $customer = new \SquareConnect\Model\CreateCustomerRequest();
        $customer->setGivenName($name);
        $customer->setEmailAddress($email);



        $customersApi = new \SquareConnect\Api\CustomersApi($this->defaultApiClient);

        try {
            $result = $customersApi->createCustomer($customer);
            $id = $result->getCustomer()->getId();
            return $id;
        } catch (Exception $e) {
            return "";
            Log::info($e->getMessage());
            //echo 'Exception when calling CustomersApi->createCustomer: ', $e->getMessage(), PHP_EOL;
        }

        return "";
    }

    public function addCard(Request $request)
    {
        $user = User::where("id", auth()->user()->id)->first();
        if (!$user) {
            return response()->json(false, 200);
        }
        //get cart
        $cart = Cart::with('product')->where('user_id', auth()->user()->id)->get();
        if ($cart->count() == 0) {
            return response()->json(false, 200);
        }

        if ($request->firstname == null || $request->firstname == '' || $request->lastname == null || $request->address1 == null || $request->mobile == null) {
            return response()->json("field", 200);
        }
        $totalAmount = $cart->sum("price");
        //add order

        $cardNonce = $request->nonce;

        $customersApi = new \SquareConnect\Api\CustomersApi($this->defaultApiClient);


        $customerId = $this->addCustomer($user->name, $user->email);

        $body = new \SquareConnect\Model\CreateCustomerCardRequest();
        $body->setCardNonce($cardNonce);

        $result = $customersApi->createCustomerCard($customerId, $body);

        $card_id = $result->getCard()->getId();
        $card_brand = $result->getCard()->getCardBrand();
        $card_last_four = $result->getCard()->getLast4();
        $card_exp_month = $result->getCard()->getExpMonth();
        $card_exp_year = $result->getCard()->getExpYear();

        $this->charge($customerId, $card_id, $totalAmount);
        $order = Order::create([
            "user_id" => auth()->user()->id,
            "orderid" => substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 20),
            "total_amount" => $totalAmount,
        ]);


        OrderDetails::create([
            "firstname" => $request->firstname,
            "lastname" => $request->lastname,
            "address" => $request->address1,
            "addresss" => $request->address2,
            "zip" => $request->zip,
            "city" => $request->city,
            "mobile" => $request->mobile,
            "order_id" => $order->id
        ]);
        //add order breakdown


        foreach ($cart as $cartItem) {
            OrderBreakDown::create([
                "product_id" => $cartItem->product_id,
                "qty" => $cartItem->quantity,
                "price" => $cartItem->price,
                "order_id" => $order->id,
            ]);

            $cartItem->delete();
        }


        return response()->json(true, 200);
    }

    public function charge($customerId, $cardId, $totalAmount)
    {


        $payments_api = new \SquareConnect\Api\PaymentsApi($this->defaultApiClient);
        $payment_body = new \SquareConnect\Model\CreatePaymentRequest();

        $amountMoney = new \SquareConnect\Model\Money();

        # Monetary amounts are specified in the smallest unit of the applicable currency.
        # This amount is in cents. It's also hard-coded for $1.00, which isn't very useful.
        $amountMoney->setAmount($totalAmount * 100);
        $amountMoney->setCurrency("USD");
        $payment_body->setCustomerId($customerId);
        $payment_body->setSourceId($cardId);
        $payment_body->setAmountMoney($amountMoney);
        $payment_body->setLocationId($this->locationId);

        # Every payment you process with the SDK must have a unique idempotency key.
        # If you're unsure whether a particular payment succeeded, you can reattempt
        # it with the same idempotency key without worrying about double charging
        # the buyer.
        $payment_body->setIdempotencyKey(uniqid());

        try {
            $result = $payments_api->createPayment($payment_body);
            $transaction_id = $result->getPayment()->getId();
            return $transaction_id;
        } catch (\SquareConnect\ApiException $e) {
            echo "Exception when calling PaymentsApi->createPayment:";
            var_dump($e->getResponseBody());
        }
    }
}
