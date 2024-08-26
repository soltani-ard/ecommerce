@extends('admin.layouts.master')
@section('title')
    {{ config('app.name') }}-نمایش دسته بندی‌
@endsection
@section('page-header')
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class='bx bx-category'></i></div>
                            نمایش دسته بندی‌
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection
@section('content')
    <div class="container-xl px-4">
        <div class="card">
            <div class="card-header"> دسته بندی‌ : {{$category->name}}
            </div>
            <div class="card-body">
                <!-- ردیف اول-->
                <div class="row gx-3 mb-3">
                    <!-- نام-->
                    <div class="col-md-2">
                        <label class="small mb-1">نام دسته بندی‌</label>
                        <input class="form-control" type="text" value="{{$category->name}}" disabled>
                    </div>
                    <!-- نامک-->
                    <div class="col-md-2">
                        <label class="small mb-1">نامک انگلیسی‌</label>
                        <input class="form-control" type="text" value="{{$category->slug}}" disabled>
                    </div>
                    <!-- والد-->
                    <div class="col-md-2">
                        <label class="small mb-1">والد</label>
                        <input class="form-control" type="text"
                               value="{{$category->parent_id == 0 ? 'دسته ‌اصلی' : $category->parent->name}}" disabled>
                    </div>
                    <!-- وضعیت-->
                    <div class="col-md-2">
                        <label class="small mb-1">وضعیت دسته بندی‌</label>
                        <input class="form-control" type="text" value="{{$category->is_active}}" disabled>
                    </div>
                    <!-- آیکون -->
                    <div class="col-md-2">
                        <label class="small mb-1">آیکون</label>
                        <input class="form-control" type="text"
                               value="{{$category->icon}}" disabled>
                    </div>
                    <!-- تاریخ ایجاد -->
                    <div class="col-md-2">
                        <label class="small mb-1">تاریخ ایجاد</label>
                        <input class="form-control" type="text" value="{{verta($category->created_at)->format('Y-n-j')}}" disabled>
                    </div>
                </div>
                <!-- ردیف دوم -->
                <div class="row gx-3 mb-3">

                    <!-- توضیحات -->
                    <div class="col-md-12">
                        <label class="small mb-1">توضیحات</label>
                        <textarea class="form-control"  rows="5" disabled>{{$category->description}}</textarea>
                    </div>
                </div>

                <!-- ردیف سوم -->
                <div class="row gx-3 mb-3">
                    <!-- ویژگی‌ها -->
                    <div class="col-md-5">
                        <label class="small mb-1">ویژگی‌ها</label>
                        <input class="form-control" type="text"
                               value="{{join(", ", $category->attributes->pluck('name')->toArray())}}" disabled>
                    </div>
                    <!-- ویژگی‌های قابل فیلتر -->
                    <div class="col-md-5">
                        <label class="small mb-1">ویژگی‌های قابل فیلتر</label>
                        <input class="form-control" type="text"
                               value="{{join(", ", $category->attributes()->wherePivot('is_filter', 1)->pluck('name')->toArray())}}" disabled>
                    </div>
                    <!-- ویژگی‌های متغییر -->
                    <div class="col-md-2">
                        <label class="small mb-1">ویژگی‌های متغییر</label>
                        <input class="form-control" type="text"
                               value="{{join(", ", $category->attributes()->wherePivot('is_variation', 1)->pluck('name')->toArray())}}" disabled>
                    </div>
                </div>
                <div class="">
                    <a href="{{route('admin.categories.index')}}">
                        <button id="alert-button" class="btn btn-light w-25" type="button">بازگشت</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/admin/css/sweetalert2.min.css')}}">
@endsection
@section('scripts')
    <script src="{{asset('assets/admin/js/sweetalert2.all.min.js')}}"></script>
    <script>
        @if(session('success'))
        Swal.fire({
            title: 'موفق',
            html: "{!! session('success') !!}",
            icon: 'success',
            confirmButtonText: 'فهمیدم'
        });
        @endif
    </script>
@endsection
