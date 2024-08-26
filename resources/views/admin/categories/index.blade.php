@extends('admin.layouts.master')
@section('title')
    {{ config('app.name') }}-همه دسته بندی‌ها
@endsection
@section('page-header')
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class='bx bx-category'></i></div>
                            همه دسته بندی‌ها
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection
@section('content')
    <div class="container-xl px-4 is-rtl">

        <!-- Example DataTable for Dashboard Demo-->
        <div class="card card-header-actions mb-4">
            <div class="card-header">لیست دسته بندی‌ها ({{$categories->total()}})
                <a href="{{route('admin.categories.create')}}">
                    <button class="btn btn-sm btn-outline-primary">
                        <i class='bx bx-plus me-1'></i>
                        ثبت دسته بندی‌ جدید
                    </button>
                </a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>نام دسته‌بندی‌</th>
                        <th>نامک انگلیسی‌</th>
                        <th>والد</th>
                        <th>وضعیت دسته بندی‌</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>نام دسته‌بندی‌</th>
                        <th>نامک انگلیسی‌</th>
                        <th>والد</th>
                        <th>وضعیت دسته بندی‌</th>
                        <th>عملیات</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    @foreach($categories as $key => $category)
                        <tr>
                            <td>{{$categories->firstItem() + $key}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->slug}}</td>
                            <td>{{$category->parent_id == 0 ? 'دسته ‌اصلی' : $category->parent->name}}</td>
                            <td>
                                <div
                                    class="badge  {{$category->getRawOriginal('is_active') ? 'bg-success' : 'bg-danger'}} text-white rounded-pill">
                                    {{$category->is_active }}
                                </div>
                            </td>
                            <td>
                                <a href="{{route('admin.categories.show', ['category' => $category->id])}}"
                                   style="text-decoration: none">
                                    <button class="btn btn-datatable btn-icon btn-transparent-dark me-2"><i
                                            class="bx bx-show"></i></button>
                                </a>
                                <a href="{{route('admin.categories.edit', ['category' => $category->id])}}"
                                   style="text-decoration: none">
                                    <button class="btn btn-datatable btn-icon btn-transparent-dark me-2"><i
                                            class="bx bx-pencil"></i></button>
                                </a>
                                <form action="{{ route('admin.categories.destroy', ['category' => $category->id]) }}"
                                      method="POST" id="delete-form-{{ $category->id }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-datatable btn-icon btn-transparent-dark"
                                            onclick="confirmDelete({{ $category->id }},'{{ $category->name }}')">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/admin/css/sweetalert2.min.css')}}">
@endsection
@section('scripts')
    <script src="{{asset('assets/admin/js/simple-datatables-latest.js')}}"></script>
    <script src="{{asset('assets/admin/js/simple-datatables-demo.js')}}"></script>
    <script src="{{asset('assets/admin/js/sweetalert2.all.min.js')}}"></script>
    <script>
        @if(session('success'))
        Swal.fire({
            title: 'موفق',
            html: "{!! session('success') !!}",
            icon: 'success',
            confirmButtonText: 'فهمیدم'
        });
        @elseif(session('error'))
        Swal.fire({
            title: 'ناموفق',
            html: "{!! session('error') !!}",
            icon: 'error',
            confirmButtonText: 'فهمیدم'
        });
        @endif
        function confirmDelete(categoryId, categoryName) {
            Swal.fire({
                title: "آیا برای حذف مطمئن هستید؟",
                text: "بعد از حذف امکان بازیابی وجود ندارد.",
                icon: "هشدار",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "بله حذف کن",
                cancelButtonText: "انصراف"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + categoryId).submit();
                    Swal.fire({
                        title: "حذف " + categoryName,
                        text: "عملیات حذف با موفقیت انجام شد.",
                        icon: "success"
                    });
                }
            });
        }
    </script>
@endsection
