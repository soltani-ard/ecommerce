<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = Category::latest()->paginate(20);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $parentCategories = Category::where('parent_id', 0)->get();
        $attributes = Attribute::all();
        $categories = Category::all();
        return view('admin.categories.create', compact('parentCategories', 'attributes', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|unique:categories,slug',
            'parent_id' => 'required',
            'attribute_ids' => 'required',
            'attribute_is_filter_ids' => 'required',
            'variation_id' => 'required',
        ]);

        try {
            // start the transaction
            DB::beginTransaction();

            // insert the category
            $category = Category::create([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'slug' => $request->slug,
                'description' => $request->description,
                'is_active' => $request->is_active,
                'icon' => $request->icon,
            ]);

            // insert the pivot table 'attribute_category'
            foreach ($request->attribute_ids as $attribute_id) {
                $attribute = Attribute::findOrFail($attribute_id);
                $attribute->categories()->attach($category->id, [
                    'is_filter' => in_array($attribute_id, $request->attribute_is_filter_ids) ? 1 : 0,
                    'is_variation' => $attribute_id == $request->variation_id ? 1 : 0
                ]);
            }
            // commit the transaction
            DB::commit();
        } catch (Exception $e) {
            // rollback the transaction
            DB::rollBack();
            return redirect()->route('admin.categories.index')->with('error', "دسته‌بندی <strong>$request->name</strong> با خطا مواجه شد.");
        }
        return redirect()->route('admin.categories.index')->with('success', "دسته‌بندی  <strong>$request->name</strong> با موفقیت اضافه گردید.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): View
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): View
    {
        $parentCategories = Category::where('parent_id', 0)->get();
        $attributes = Attribute::all();
        return view('admin.categories.edit', compact('parentCategories', 'attributes', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|unique:categories,slug,'.$category->id,
            'parent_id' => 'required',
            'attribute_ids' => 'required',
            'attribute_is_filter_ids' => 'required',
            'variation_id' => 'required',
        ]);

        try {
            // start the transaction
            DB::beginTransaction();

            // insert the category
            $category->update([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'slug' => $request->slug,
                'description' => $request->description,
                'is_active' => $request->is_active,
                'icon' => $request->icon,
            ]);

            $category->attributes()->detach();
            // insert the pivot table 'attribute_category'
            foreach ($request->attribute_ids as $attribute_id) {
                $attribute = Attribute::findOrFail($attribute_id);
                $attribute->categories()->attach($category->id, [
                    'is_filter' => in_array($attribute_id, $request->attribute_is_filter_ids) ? 1 : 0,
                    'is_variation' => $attribute_id == $request->variation_id ? 1 : 0
                ]);
            }
            // commit the transaction
            DB::commit();
        } catch (Exception $e) {
            // rollback the transaction
            DB::rollBack();
            return redirect()->route('admin.categories.index')->with('error', "ویرایش دسته‌بندی  <strong>$request->name</strong> با خطا مواجه شد.");
        }
        return redirect()->route('admin.categories.index')->with('success', "ویرایش دسته‌بندی  <strong>$request->name</strong> با موفقیت اضافه گردید.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showAttributes(Category $category): array
    {
        $attributes = $category->attributes()->wherePivot('is_variation', '0')->get();
        $variation = $category->attributes()->wherePivot('is_variation', '1')->first();
        return ['attributes' => $attributes, 'variation' => $variation];
    }
}
