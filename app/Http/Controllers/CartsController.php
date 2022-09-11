<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CartsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
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
        return view("main.cart", compact('categories', 'home', 'shop', 'account', 'about'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->get('product_id')) {
            return [
                'items' => Cart::where('user_id', auth()->user()->id)->count(),
            ];
        }
        $product = Product::where('id', $request->get('product_id'))->first();
        $productFoundInCart = Cart::where('product_id', $request->get('product_id'))->pluck('id');

        if ($productFoundInCart->isEmpty()) {
            $cart = Cart::create([
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->sale_price,
                'user_id' => auth()->user()->id
            ]);
        } else {

            $cart = Cart::where('product_id', $request->get('product_id'))->first();
            $cart->quantity = $cart->quantity + 1;
            $cart->price = $cart->quantity * $product->sale_price;
            $cart->save();
        }

        $userItems = Cart::where('user_id', auth()->user()->id)->count();
        return [
            'message' => 'Cart Updated',
            'items' => $userItems,
        ];
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
        $cart = Cart::where("id", $id)->first();
        $cart->quantity = $request->qty;
        $cart->price = $cart->quantity * $cart->product->sale_price;
        $cart->save();

        return response()->json(true, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::where("id", $id)->first()->delete();
        return response()->json(true, 200);
    }
    public function getCart()
    {
        if (!auth()->check()) {
            return redirect(route('home'));
        }
        $isCart = false;
        $cart = Cart::with('product')->where('user_id', auth()->user()->id)->get();
        if ($cart->count() > 0) {
            $isCart = true;
        }
        return [
            'isCart' => $isCart,
            'cart' => $cart,
            'sum' => $cart != null ? $cart->sum("price") : 0,
        ];
    }
}
