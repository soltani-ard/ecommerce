<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $banners = Banner::latest()->paginate(20);
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // validation
        $request->validate([
            'type' => 'required',
            'priority' => 'required|integer',
            'banner_image' => 'required|mimes:jpg,jpeg,png',
        ]);
        try {
            DB::beginTransaction();

            // generate image name
            $fileNameImage = generateFileName($request->banner_image);
            $request->banner_image->move(public_path(env('BANNER_IMAGES_PATH')), $fileNameImage);

            // store
            Banner::create([
                'image' => $fileNameImage,
                'title' => $request->title,
                'text' => $request->text,
                'priority' => $request->priority,
                'is_active' => $request->is_active,
                'type' => $request->type,
                'button_text' => $request->button_text,
                'button_link' => $request->button_link,
                'button_icon' => $request->button_icon,
            ]);

            DB::commit();
        } catch (Exception $e) {
            // rollback the transaction
            DB::rollBack();
            return redirect()->route('admin.banners.index')->with('error', "ایجاد بنر <strong>$request->name</strong> با خطا مواجه شد.");
        }
        return redirect()->route('admin.banners.index')->with('success', "بنر <strong>$request->name</strong> با موفقیت اضافه گردید.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
