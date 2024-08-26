@extends('admin.layouts.master')
@section('title')
    {{ config('app.name') }}-ایجاد برند
@endsection
@section('page-header')
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class='bx bx-registered'></i></div>
                            ثبت برند جدید
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection
@section('content')
    <div class="container-xl px-4">
        <div class="card card-header-actions mb-4">
            <div class="card-header">ایجاد برند
                <a href="{{route('admin.brands.index')}}">
                    <button class="btn btn-sm btn-outline-primary">
                        <i class='bx bxs-grid me-1'></i>
                        نمایش همه برندها
                    </button>
                </a>
            </div>
            <div class="card-body">
                @include('admin.sections.errors')
                <form method="POST" action="{{ route('admin.brands.store') }}">
                    @csrf
                    <div class="row gx-3 mb-3">
                        <div class="col-md-5">
                            <label class="small mb-1" for="name">نام برند</label>
                            <input class="form-control" id="name" name="name" type="text" value="{{old('name')}}"
                                   placeholder="نام برند خود را وارد کنید">
                        </div>
                        <div class="col-md-2">
                            <label class="small mb-1" for="is_active">وضعیت برند</label>
                            <select class="form-select" id="is_active" name="is_active">
                                <option value="1" selected>فعال</option>
                                <option value="0">غیر فعال</option>
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <button class="btn btn-primary me-2 w-25" type="submit">ذخیره</button>
                        <a href="{{route('admin.brands.index')}}"> <button id="alert-button" class="btn btn-light w-25" type="button">انصراف</button></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


