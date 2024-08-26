<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $tags = Tag::latest()->paginate(20);
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $tagName = htmlspecialchars($request->name, ENT_QUOTES, 'UTF-8');
        Tag::create([
            'name' => $tagName,
        ]);
        return redirect()->route('admin.tags.index')->with('success', "برچسب <strong>$tagName</strong> با موفقیت ثبت گردید.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag): View
    {
        return view('admin.tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag): View
    {
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $tagName = htmlspecialchars($request->name, ENT_QUOTES, 'UTF-8');
        $tag->update([
            'name' => $request->name,
        ]);
        return redirect()->route('admin.tags.index')->with('success', "برچسب <strong>$tagName</strong> با موفقیت ویرایش گردید.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag): RedirectResponse
    {
        $tag->delete();
        return redirect()->route('admin.tags.index');
    }
}
