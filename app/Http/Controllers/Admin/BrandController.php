<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use function Laravel\Prompts\alert;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $brands = Brand::latest()->paginate(20);
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);
        $brandName = htmlspecialchars($request->name, ENT_QUOTES, 'UTF-8');
        Brand::create([
            'name' => $brandName,
            'is_active' => $request->is_active
        ]);
        return redirect()->route('admin.brands.index')->with('success', "برند <strong>$brandName</strong> با موفقیت ثبت گردید.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand): View
    {
        return view('admin.brands.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand): View
    {
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'required|boolean',
        ]);
        $brandName = htmlspecialchars($request->name, ENT_QUOTES, 'UTF-8');
        $brand->update([
            'name' => $request->name,
            'is_active' => $request->is_active
        ]);
        return redirect()->route('admin.brands.index')->with('success', "برند <strong>$brandName</strong> با موفقیت ویرایش گردید.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand): RedirectResponse
    {
        $brand->delete();
        return redirect()->route('admin.brands.index');
    }
}
