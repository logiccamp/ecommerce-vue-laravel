<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $home = 'active';
        $shop = "";
        $account = "";
        $about = "";

        $categories = Category::with(["products", "SubCategories"])->get();
        $pageCategories = Category::with("products")->get()->take(5);

        $brands = Brand::with(["products"])->get();
        $featured = Product::all()->take(9);
        $recommended = Product::all()->take(12);
        return view('welcome', compact(['recommended', 'featured', 'categories', 'brands', 'pageCategories', 'home', 'shop', 'account', 'about']));
    }


    public function Shop()
    {
        $home = '';
        $shop = "active";
        $account = "";
        $about = "";

        $categories = Category::with(["products", "SubCategories"])->get();

        $brands = Brand::with(["products"])->get();
        $featured = Product::all();
        return view('main.shop', compact(['featured', 'categories', 'brands', 'home', 'shop', 'account', 'about']));
    }

    public function Category($title)
    {
        $home = '';
        $shop = "";
        $account = "";
        $about = "";
        $thisCat = Category::where("title", $title)->first();

        $cat = $thisCat->title;
        $categories = Category::with(["products", "SubCategories"])->get();

        $brands = Brand::with(["products"])->get();

        $featured = [];

        $f = ProductCategory::with("products")->where("category_id", $thisCat->id)->get();

        foreach ($f as $fs) {
            array_push($featured, $fs->products[0]);
        }

        return view('main.category', compact(['featured', 'categories', 'brands', 'home', 'shop', 'account', 'about', "cat"]));
    }



    public function About()
    {
        $home = '';
        $shop = "";
        $account = "";
        $about = "active";

        $categories = Category::with(["products", "SubCategories"])->get();

        $brands = Brand::with(["products"])->get();
        $featured = Product::all();
        return view('main.about', compact(['featured', 'categories', 'brands', 'home', 'shop', 'account', 'about']));
    }


    public function Shipping()
    {
        $home = '';
        $shop = "";
        $account = "";
        $about = "";

        $categories = Category::with(["products", "SubCategories"])->get();

        $brands = Brand::with(["products"])->get();
        $featured = Product::all();
        return view('main.shipping', compact(['featured', 'categories', 'brands', 'home', 'shop', 'account', 'about']));
    }


    public function returnP()
    {
        $home = '';
        $shop = "";
        $account = "";
        $about = "";

        $categories = Category::with(["products", "SubCategories"])->get();

        $brands = Brand::with(["products"])->get();
        $featured = Product::all();
        return view('main.returnp', compact(['featured', 'categories', 'brands', 'home', 'shop', 'account', 'about']));
    }

    public function terms()
    {
        $home = '';
        $shop = "";
        $account = "";
        $about = "";

        $categories = Category::with(["products", "SubCategories"])->get();

        $brands = Brand::with(["products"])->get();
        $featured = Product::all();
        return view('main.terms', compact(['featured', 'categories', 'brands', 'home', 'shop', 'account', 'about']));
    }

    public function account()
    {
        if (!auth()->check()) {
            return redirect("/login");
        }
        $home = '';
        $shop = "";
        $account = "";
        $about = "";

        $categories = Category::with(["products", "SubCategories"])->get();

        $brands = Brand::with(["products"])->get();
        $featured = Product::all();
        return view('main.account', compact(['featured', 'categories', 'brands', 'home', 'shop', 'account', 'about']));
    }
}
