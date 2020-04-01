<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\ProductPhotos;
use App\Store;
use App\Traits\UploadTrait;

class ProductController extends Controller
{
    use UploadTrait;
    private $product;

    /**
     * ProductController constructor.
     * @param $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user()->store;
        $products = $user->products()->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = \App\Category::all(['name', 'id']);

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\ProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $categories = $request->get('categories', null);

        $store = auth()->user()->store;
        $product = $store->products()->create($data);
        $product->categories()->sync($categories);

        if ($request->hasFile('photos')) {
            $photos = $request->file('photos');
            $uploadedPhotos = $this->imageUpload($photos, 'products', 'image');

            $product->photos()->createMany($uploadedPhotos);
        }

        flash(__('Product created with success'))->success();
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = \App\Category::all(['name', 'id']);
        $product = $this->product->findOrFail($id);

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\ProductRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        $categories = $request->get('categories', null);

        $product = $this->product->find($id);
        $product->update($data);

        if ($categories) {
            $product->categories()->sync($categories);
        }

        if ($request->hasFile('photos')) {
            $photos = $request->file('photos');
            $uploadedPhotos = $this->imageUpload($photos, 'products', 'image');

            $product->photos()->createMany($uploadedPhotos);
        }

        flash(__('Product updated with success'))->success();
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->product->findOrFail($id);
        $product->delete();
        $product->photos()->delete();

        flash(__('Product deleted with success'))->success();
        return redirect()->route('admin.products.index');
    }
}
