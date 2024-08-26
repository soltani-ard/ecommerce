<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributes = Attribute::latest()->paginate(20);
        return view('admin.attributes.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $attributeName = htmlspecialchars($request->name, ENT_QUOTES, 'UTF-8');
        Attribute::create([
            'name' => $attributeName,
        ]);
        return redirect()->route('admin.attributes.index')->with('success', "ویژگی <strong>$attributeName</strong> با موفقیت ثبت گردید.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Attribute $attribute): View
    {
        return view('admin.attributes.show', compact('attribute'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attribute $attribute): View
    {
        return view('admin.attributes.edit', compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attribute $attribute): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $attributeName = htmlspecialchars($request->name, ENT_QUOTES, 'UTF-8');
        $attribute->update([
            'name' => $request->name,
        ]);
        return redirect()->route('admin.attributes.index')->with('success', "ویژگی <strong>$attributeName</strong> با موفقیت ویرایش گردید.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attribute $attribute): RedirectResponse
    {
        $attribute->delete();
        return redirect()->route('admin.attributes.index');
    }
}
