<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderBreakDown;
use App\Models\OrderDetails;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $home = '';
        $shop = "";
        $account = "";
        $about = "";
        $categories = Category::with(["products", "SubCategories"])->get();
        return view("main.orders", compact("home", 'shop', 'account', 'about', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function complete()
    {
        $home = '';
        $shop = "";
        $account = "";
        $about = "";
        $categories = Category::with(["products", "SubCategories"])->get();
        return view("main.orderComplete", compact("home", 'shop', 'account', 'about', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "firstname" => 'required',
            "lastname" => 'required',
            "address1" => 'required',
            "address2" => '',
            "zip" => '',
            "state" => 'required',
            "city" => 'required',
            "mobile" => 'required',
            // firstname, lastname, address1, address2, zip, state, city, mobile
        ]);
        //get active user
        $user = User::where("id", auth()->user()->id)->first();
        if (!$user) {
            redirect("/home");
        }


        //get cart
        $cart = Cart::with('product')->where('user_id', auth()->user()->id)->get();
        if ($cart->count() == 0) {
            redirect("/cart");
        }


        $totalAmount = $cart->sum("price");
        //add order
        $order = Order::create([
            "user_id" => auth()->user()->id,
            "orderid" => $request->_token,
            "total_amount" => $totalAmount,
        ]);

        //add order details
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

            // $cartItem->delete();
        }


        //redirect to success page with order id
        return redirect("/order-complete");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getOrder()
    {
        $orders = Order::with(["BreakDown", "Details"])->where("user_id", auth()->user()->id)->get();
        foreach ($orders as $order) {
            foreach ($order->BreakDown as $orderr) {
                $thisBreakdown = OrderBreakDown::with("Product")->where("id", $orderr->id)->first();
                $orderr["product"] = $thisBreakdown->Product;
            }

            $order["ddate"] = Carbon::createFromDate($order->created_at)->diffForHumans();
        }

        return response()->json($orders, 200);
    }
}
