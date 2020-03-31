<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductPhotosController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removePhoto(Request $request)
    {
        $photoName = ($request->all())['photoName'];

        if (Storage::disk('public')->exists($photoName)) {
            Storage::disk('public')->delete($photoName);
        }

        $photo = \App\ProductPhotos::where('image', $photoName);
        $productId = $photo->first()->product_id;
        $photo->delete();

        flash(__('Image deleted with success.'))->success();
        return redirect()->route('admin.products.edit', $productId);
    }
}
