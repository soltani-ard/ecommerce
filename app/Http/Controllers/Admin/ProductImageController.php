<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProductImageController extends Controller
{
    public function upload($primaryImage, $images): array
    {
        // primary image upload
        $fileNamePrimaryImage = generateFileName($primaryImage);
        $primaryImage->move(public_path(env('PRODUCT_IMAGES_PATH')), $fileNamePrimaryImage);

        // other product images upload
        $uploadedImagesName = [];
        foreach ($images as $image) {
            $fileName = generateFileName($image);
            $image->move(public_path(env('PRODUCT_IMAGES_PATH')), $fileName);
            $uploadedImagesName[] = $fileName;
        }

        return [
            'primary_image' => $fileNamePrimaryImage,
            'images' => $uploadedImagesName
        ];

    }


    public function editImages(Product $product): View
    {
        $productImages = $product->images;
        return view('admin.products.edit_images', compact('product', 'productImages'));
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'image_id' => 'required|exists:product_images,id',
        ]);
        try {
            ProductImage::destroy($request->image_id);
            return redirect()->back()->with('success', "عکس محصول با موفقیت حذف شد.");
        } catch (Exception $exception) {
            return redirect()->back()->with('error', "خطایی در حذف عکس رخ داده است.");
        }

    }

    public function setPrimary(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'image_id' => 'required|exists:product_images,id',
        ]);
        try {
            $productImage = ProductImage::findOrFail($request->image_id);
            $product->update([
                'primary_image' => $productImage->image
            ]);
            return redirect()->back()->with('success', "عکس اصلی محصول با موفقیت ویرایش شد.");
        } catch (Exception $exception) {
            return redirect()->back()->with('error', "خطایی در ویرایش عکس اصلی محصول رخ داده است.");
        }

    }

    public function store(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'primary_image' => 'nullable|mimes:jpeg,png,jpg|max:2048',
            'images.*' => 'nullable|mimes:jpeg,png,jpg|max:2048',
        ]);


        // upload images
        if ($request->primary_image == null && $request->images == null) {
            return redirect()->back()->with('error', "لطفا حداقل یک عکس را انتخاب کنید.");
        }

        try {
            DB::beginTransaction();
            // check primary image exists
            if ($request->has('primary_image')) {
                // primary image upload
                $fileNamePrimaryImage = generateFileName($request->primary_image);
                $request->primary_image->move(public_path(env('PRODUCT_IMAGES_PATH')), $fileNamePrimaryImage);

                // update primary image
                $product->update([
                    'primary_image' => $fileNamePrimaryImage
                ]);
            }

            // check images exists
            if ($request->has('images')) {
                // other product images upload
                foreach ($request->images as $image) {
                    $fileName = generateFileName($image);
                    $image->move(public_path(env('PRODUCT_IMAGES_PATH')), $fileName);
                    // update product images
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image' => $fileName
                    ]);

                }
            }
            DB::commit();
        } catch (Exception $e) {
            // rollback the transaction
            DB::rollBack();
            return redirect()->back()->with('error', "خطایی در بارگذاری عکس‌ها رخ داده است.");
        }
        return redirect()->back()->with('success', "تصویر محصول با موفقیت بروزرسانی شد.");
    }
}
