@extends('admin.layouts.master')
@section('title')
    {{ config('app.name') }}-همه محصولات
@endsection
@section('page-header')
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class='bx bx-store'></i></div>
                            همه محصولات
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
            <div class="card-header">لیست محصولات ({{$products->total()}})
                <a href="{{route('admin.products.create')}}">
                    <button class="btn btn-sm btn-outline-primary">
                        <i class='bx bx-plus me-1'></i>
                        ثبت محصول جدید
                    </button>
                </a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>نام محصول</th>
                        <th>نام برند</th>
                        <th>نام دسته‌بندی</th>
                        <th> وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>نام محصول</th>
                        <th>نام برند</th>
                        <th>نام دسته‌بندی</th>
                        <th> وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    @foreach($products as $key => $product)
                        <tr>
                            <td>{{$products->firstItem() + $key}}</td>
                            <td><a href="{{route('admin.products.show', ['product' => $product->id])}}"
                                   style="text-decoration: none">{{$product->name}}</a></td>
                            <td><a href="{{route('admin.brands.show', ['brand' => $product->brand->id])}}"
                                   style="text-decoration: none">{{$product->brand->name}}</a></td>
                            <td><a href="{{route('admin.categories.show', ['category' => $product->category->id])}}"
                                   style="text-decoration: none">{{$product->category->name}}</a></td>
                            <td>
                                <div
                                    class="badge  {{$product->getRawOriginal('is_active') ? 'bg-success' : 'bg-danger'}} text-white rounded-pill">
                                    {{$product->is_active }}
                                </div>
                            </td>
                            <td>
                                <!-- Button trigger modal -->
                                <button class="btn  btn-sm btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$product->id}}"> ویرایش | نمایش | حذف </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal-{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-{{$product->id}}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel-{{$product->id}}">عملیات قابل انجام روی یک محصول</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="بستن"></button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="mb-1 p-2 fw-bold">
                                                    <a href="{{route('admin.products.show', ['product' => $product->id])}}"
                                                       style="text-decoration: none">
                                                        <button class="btn btn-xs btn-blue btn-icon" type="button">
                                                            <i class="bx bx-show"></i>
                                                        </button>
                                                        <span class="text-dark">نمایش محصول</span>
                                                    </a>
                                                </div>

                                                <div class="mb-1 p-2 fw-bold">
                                                    <a href="{{route('admin.products.edit', ['product' => $product->id])}}"
                                                       style="text-decoration: none">
                                                        <button class="btn btn-xs btn-orange btn-icon" type="button">
                                                            <i class="bx bx-pencil"></i>
                                                        </button>
                                                        <span class="text-dark">ویرایش محصول</span>
                                                    </a>
                                                </div>

                                                <div class="mb-1 p-2 fw-bold">
                                                    <a href="{{route('admin.products.images.edit', ['product' => $product->id])}}"
                                                       style="text-decoration: none">
                                                        <button class="btn btn-xs btn-orange btn-icon" type="button">
                                                            <i class="bx bx-image"></i>
                                                        </button>
                                                        <span class="text-dark">ویرایش تصویر محصول</span>
                                                    </a>
                                                </div>

                                                <div class="mb-1 p-2 fw-bold">
                                                    <a href="{{route('admin.products.category.edit', ['product' => $product->id])}}"
                                                       style="text-decoration: none">
                                                        <button class="btn btn-xs btn-orange btn-icon" type="button">
                                                            <i class="bx bx-category"></i>
                                                        </button>
                                                        <span class="text-dark">ویرایش دسته بندی و ویژگی محصول</span>
                                                    </a>
                                                </div>

                                                <div class="mb-1 p-2 fw-bold">
                                                    <form action="{{ route('admin.products.destroy', ['product' => $product->id]) }}"
                                                          method="POST" id="delete-form-{{ $product->id }}" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-xs btn-red btn-icon"
                                                                onclick="confirmDelete({{ $product->id }},'{{ $product->name }}')">
                                                            <i class="bx bx-trash"></i>
                                                        </button>
                                                        <span class="text-dark">حذف محصول</span>
                                                    </form>
                                                </div>



                                            </div>
                                            <div class="modal-footer"><button class="btn btn-secondary" type="button" data-bs-dismiss="modal">بستن</button></div>
                                        </div>
                                    </div>
                                </div>
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
        @endif
        function confirmDelete(productId, productName) {
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
                    document.getElementById('delete-form-' + productId).submit();
                    Swal.fire({
                        title: "حذف " + productName,
                        text: "عملیات حذف با موفقیت انجام شد.",
                        icon: "success"
                    });
                }
            });
        }
    </script>
@endsection
