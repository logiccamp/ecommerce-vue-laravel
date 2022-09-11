<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $home = '';
        $shop = "";
        $account = "";
        $about = "";
        $categories = Category::with(["products", "SubCategories"])->get();


        $product = Product::where("slug", $id)->first();
        $productCategories = $product->categories;
        $categoriesArray = [];
        foreach ($productCategories as $productCat) {
            $thisCat = ProductCategory::where("category_id", $productCat->category_id)->first();
            if ($thisCat) {
                foreach ($thisCat->products as $thisCatItem) {
                    array_push($categoriesArray, $thisCatItem);
                }
            }
        }
        shuffle($categoriesArray);
        return view('main.product', [
            "product" => $product,
            "related" => $categoriesArray,
            "categories" => $categories,
            "home" => $home,
            "shop" => $shop,
            "account" => $account,
            "about" => $about,
        ]);
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


    public function getProduct(Request $request)
    {
        $url = $request->path;
        $slug = str_replace("/product/", "", $url);
        $product = Product::where("slug", $slug);
        $data = [
            "product" => $product->first()
        ];

        return response()->json($product->first(), 200);
    }
}
