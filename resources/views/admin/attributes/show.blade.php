@extends('admin.layouts.master')
@section('title')
    {{ config('app.name') }}-نمایش ویژگی
@endsection
@section('page-header')
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class='bx bx-git-pull-request'></i></div>
                            نمایش ویژگی
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
            <div class="card-header"> ویژگی  : {{$attribute->name}}
            </div>
            <div class="card-body">
                <div class="row gx-3 mb-3">
                    <div class="col-md-2">
                        <label class="small mb-1">نام ویژگی </label>
                        <input class="form-control" type="text" value="{{$attribute->name}}" disabled>
                    </div>
                    <div class="col-md-2">
                        <label class="small mb-1">تاریخ ایجاد</label>
                        <input class="form-control" type="text" value="{{verta($attribute->created_at)->format('Y-n-j')}}" disabled>
                    </div>
                </div>
                <div class="">
                   <a href="{{route('admin.attributes.index')}}"> <button id="alert-button" class="btn btn-light w-25" type="button">بازگشت</button></a>
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
