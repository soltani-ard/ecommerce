@extends('admin.layouts.master')
@section('title')
    {{ config('app.name') }}-ویرایش برچسب
@endsection
@section('page-header')
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class='bx bx-purchase-tag'></i></div>
                            ویرایش برچسب  جدید
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
            <div class="card-header"> ویرایش برچسب : {{$tag->name}}
                <a href="{{route('admin.tags.index')}}">
                    <button class="btn btn-sm btn-outline-primary">
                        <i class='bx bxs-grid me-1'></i>
                        نمایش همه برچسب ها
                    </button>
                </a>
            </div>
            <div class="card-body">
                @include('admin.sections.errors')
                <form method="POST" action="{{ route('admin.tags.update', ['tag' => $tag->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="row gx-3 mb-3">
                        <div class="col-md-5">
                            <label class="small mb-1" for="name">نام برچسب </label>
                            <input class="form-control" id="name" name="name" type="text" value="{{$tag->name}}"
                                   placeholder="نام برچسب  خود را وارد کنید">
                        </div>
                    </div>
                    <div class="">
                        <button class="btn btn-primary me-2 w-25" type="submit">ویرایش</button>
                        <a href="{{route('admin.tags.index')}}"> <button id="alert-button" class="btn btn-light w-25" type="button">انصراف</button></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

