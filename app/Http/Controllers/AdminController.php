<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function upload()
    {
        $home = '';
        $shop = "";
        $account = "";
        $about = "";

        $categories = Category::with(["products", "SubCategories"])->get();

        $brands = Brand::with(["products"])->get();
        $featured = Product::all();
        return view('main.upload', compact(['featured', 'categories', 'brands', 'home', 'shop', 'account', 'about']));
    }

    public function uploadthis(Request $request)
    {
        dd($request);
        $slug = "";
        Product::create([
            "name" => $request->title,
            "price" => $request->cp,
            "sale_price" => $request->sp,
            "description" => $request->description,
            "image_name" => $request->image,
            "slug" => $slug,
            // image, categories, sp, cp, title, description
            // price, image_name, slug, description, sale_price
            // name, slug, description, image_name, price, sale_price,
            // slug => Str::slug() , description, image_name, price, sale_price
        ]);
    }
}
