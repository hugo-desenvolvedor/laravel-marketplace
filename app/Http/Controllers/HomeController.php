<?php

namespace App\Http\Controllers;

use App\Store;
use Illuminate\Http\Request;
use App\Product;

class HomeController extends Controller
{
    private Product $product;

    /**
     * HomeController constructor.
     * @param $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = $this->product->limit(6)->get();
        $stores = Store::limit(3)->get();

        return view('welcome', compact('products', 'stores'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function single($slug)
    {
        $product = $this->product->whereSlug($slug)->first();

        return view('single', compact('product'));
    }
}
