<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public array $cart;

    /**
     * Index page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $cart = session()->has('cart') ? session()->get('cart') :  [];

        return view('cart', compact('cart'));
    }

    /**
     * Create or add item to cart session
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request)
    {
        $data = $request->get('product');
        $product = Product::whereSlug($data['slug']);

        if (!$product->count()) {
            return redirect()->route('home');
        }

        $product = $product->first(['name', 'price', 'store_id'])->toArray();
        $product = array_merge($data, $product);

        if (session()->has('cart')) {
            $products = session()->get('cart');
            $productSlugs = array_column($products, 'slug');

            if (in_array($product['slug'], $productSlugs)) {
                $products = $this->productIncrement($product['slug'], $product['amount'], $products);
                session()->put('cart', $products);
            } else {
                session()->push('cart', $product);
            }
        } else {
            $products[] = $product;
            session()->put('cart', $products);
        }

        flash(__('Product added to cart'))->success();
        return redirect()->route('product.single', ['slug' => $product['slug']]);
    }

    /**
     * Increment the shop cart amount.
     *
     * @param $slug
     * @param $amount
     * @param $products
     * @return array
     */
    private function productIncrement($slug, $amount, $products)
    {
        return array_map(function ($value) use ($slug, $amount) {
            if ($slug == $value['slug']) {
                $value['amount'] += $amount;
            }

            return $value;
        }, $products);
    }

    /**
     * Remove product from cart
     *
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove($slug)
    {
        if (!session()->has('cart')) {
            return redirect()->route('cart.index');
        }

        $products = session()->get('cart');

        $products = array_filter($products, function ($line) use ($slug) {
            return $line['slug'] != $slug;
        });

        session()->put('cart', 'products');

        flash(__('Product delete from cart'))->success();
        return redirect()->route('cart.index');
    }

    /**
     * Remove all products from Cart
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel()
    {
        session()->forget('cart');

        flash(__('Cart cancelled'))->success();
        return redirect()->route('cart.index');
    }
}
