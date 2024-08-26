<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\ProductVariation;
use App\Models\Tag;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $products = Product::latest()->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $brands = Brand::all();
        $tags = Tag::all();
        $categories = Category::where('parent_id', '!=', 0)->get();
        return view('admin.products.create', compact('brands', 'tags', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand_id' => 'required',
            'is_active' => 'required',
            'tag_ids' => 'required',
            'description' => 'required',
            'primary_image' => 'required|mimes:jpeg,png,jpg|max:2048',
            'images' => 'required',
            'images.*' => 'required|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'required',
            'attribute_ids' => 'required',
            'attribute_ids.*' => 'required',
            'variation_values' => 'required',
            'variation_values.*.*' => 'required',
            'variation_values.price.*' => 'integer|min:0',
            'variation_values.quantity.*' => 'integer|min:0',
            'delivery_amount' => 'required|integer|min:0',
            'delivery_amount_per_product' => 'nullable|integer|min:0',
        ]);

        try {
            DB::beginTransaction();
            // upload images [primary, others]
            $productImageController = new ProductImageController();
            $uploadedImagesName = $productImageController->upload($request->primary_image, $request->images);

            // create product with base fields
            $product = Product::create([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'primary_image' => $uploadedImagesName['primary_image'],
                'description' => $request->description,
                'is_active' => $request->is_active,
                'delivery_amount' => $request->delivery_amount,
                'delivery_amount_per_product' => $request->delivery_amount_per_product,
            ]);

            // insert product tags
            $product->tags()->attach($request->tag_ids);

            // insert product images
            foreach ($uploadedImagesName['images'] as $image) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $image
                ]);
            }

            // insert product attributes
            $productAttributeController = new ProductAttributeController();
            $productAttributeController->store($product, $request->attribute_ids);

            // insert product variations
            $category = Category::find($request->category_id); // find category
            $attribute_id = $category->attributes()->wherePivot('is_variation', 1)->first()->id; // only one variation in each category
            $productVariationController = new ProductVariationController();
            $productVariationController->store($request->variation_values, $attribute_id, $product);

            DB::commit();
        } catch (Exception $e) {
            // rollback the transaction
            DB::rollBack();
            return redirect()->route('admin.products.index')->with('error', "ایجاد محصول <strong>$request->name</strong> با خطا مواجه شد.");
        }
        return redirect()->route('admin.products.index')->with('success', "محصول <strong>$request->name</strong> با موفقیت اضافه گردید.");

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        $productAttributes = $product->attributes()->with('attribute')->get();
        $productVariations = $product->variations;
        $productImages = $product->images;
        return view('admin.products.show', compact( 'product', 'productAttributes', 'productVariations', 'productImages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        $brands = Brand::all();
        $tags = Tag::all();
        $categories = Category::where('parent_id', '!=', 0)->get();
        $productAttributes = $product->attributes()->with('attribute')->get();
        $productVariations = $product->variations;
        $productImages = $product->images;
        return view('admin.products.edit', compact('product', 'categories', 'brands', 'tags', 'productAttributes', 'productVariations', 'productImages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'is_active' => 'required',
            'tag_ids' => 'required|exists:tags,id',
            'description' => 'required',
            'attribute_values' => 'required',
            'variation_values' => 'required',
            'variation_values.*.price' => 'required|integer',
            'variation_values.*.quantity' => 'required|integer',
            'variation_values.*.sale_price' => 'nullable|integer',
            'variation_values.*.date_on_sale_from' => 'nullable|date',
            'variation_values.*.date_on_sale_to' => 'nullable|date',
            'delivery_amount' => 'required|integer|min:0',
            'delivery_amount_per_product' => 'nullable|integer|min:0',
        ]);

        try {
            DB::beginTransaction();

            // update product with base fields
            $product->update([
                'name' => $request->name,
                'brand_id' => $request->brand_id,
                'description' => $request->description,
                'is_active' => $request->is_active,
                'delivery_amount' => $request->delivery_amount,
                'delivery_amount_per_product' => $request->delivery_amount_per_product,
            ]);

            // update product tags
            $product->tags()->sync($request->tag_ids);


            // update product attributes
            $productAttributeController = new ProductAttributeController();
            $productAttributeController->update($request->attribute_values);

            // update product variations
            $productVariationController = new ProductVariationController();
            $productVariationController->update($request->variation_values);

            DB::commit();
        } catch (Exception $e) {
            // rollback the transaction
            DB::rollBack();
            return redirect()->route('admin.products.index')->with('error', "ویرایش محصول <strong>$request->name</strong> با خطا مواجه شد.");
        }
        return redirect()->route('admin.products.index')->with('success', "محصول <strong>$request->name</strong> با موفقیت ویرایش گردید.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function categoryEdit(Request $request, Product $product): View
    {
        $categories = Category::where('parent_id', '!=', 0)->get();
        return view('admin.products.category_edit', compact('product', 'categories'));
    }

    public function categoryUpdate (Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'category_id' => 'required',
            'attribute_ids' => 'required',
            'attribute_ids.*' => 'required',
            'variation_values' => 'required',
            'variation_values.*.*' => 'required',
            'variation_values.price.*' => 'integer|min:0',
            'variation_values.quantity.*' => 'integer|min:0',
        ]);

        try {
            DB::beginTransaction();

            // update product category
            $product->update([
                'category_id' => $request->category_id,
            ]);


            // insert product attributes
            $productAttributeController = new ProductAttributeController();
            $productAttributeController->change($product, $request->attribute_ids);

            // insert product variations
            $category = Category::find($request->category_id); // find category
            $attribute_id = $category->attributes()->wherePivot('is_variation', 1)->first()->id; // only one variation in each category
            $productVariationController = new ProductVariationController();
            $productVariationController->change($request->variation_values, $attribute_id, $product);

            DB::commit();
        } catch (Exception $e) {
            // rollback the transaction
            DB::rollBack();
            return redirect()->route('admin.products.index')->with('error', "ایجاد محصول <strong>$request->name</strong> با خطا مواجه شد.");
        }
        return redirect()->route('admin.products.index')->with('success', "محصول <strong>$request->name</strong> با موفقیت اضافه گردید.");
    }
}
