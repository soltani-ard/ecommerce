@extends('admin.layouts.master')
@section('title')
    {{ config('app.name') }}-ویرایش تصاویر محصول
@endsection
@section('page-header')
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class='bx bx-image'></i></div>
                            ویرایش تصاویر محصول
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
            <div class="card-header"> ویرایش تصاویر محصول : {{$product->name}}
                <a href="{{route('admin.products.index')}}">
                    <button class="btn btn-sm btn-outline-primary">
                        <i class='bx bxs-grid me-1'></i>
                        نمایش همه محصولات
                    </button>
                </a>
            </div>
            <div class="card-body">
                <!-- ردیف نمایش تصویر -->
                <div class="row gx-3 mb-3">
                    <label class="mb-1 mb-3 fw-bolder">* تصویر اصلی </label>
                    <div class="col-md-3 d-flex flex-column align-items-center">
                        <div class="image-container" style="width: 300px; height: 300px; overflow: hidden;">
                            <img class="img-fluid rounded-3"
                                 src="{{ url(env('PRODUCT_IMAGES_PATH').$product->primary_image) }}"
                                 alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    </div>
                    <label class="mb-1 mt-5 mb-3 fw-bolder">* سایر تصاویر </label>
                    @foreach($productImages as $productImage)
                        <div class="col-md-3 d-flex flex-column align-items-center">
                            <div class="image-container" style="width: 300px; height: 300px; overflow: hidden;">
                                <img class="img-fluid rounded-3"
                                     src="{{ url(env('PRODUCT_IMAGES_PATH').$productImage->image) }}"
                                     alt="{{ $product->name }}"
                                     style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <form
                                action="{{ route('admin.products.images.set_primary', ['product'=> $product->id])}}"
                                method="POST">
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="image_id" value="{{ $productImage->id }}">
                                <button class="btn btn-primary mt-2" type="submit"><i class="bx bx-image me-1"></i>قرار
                                    دادن به عنوان تصویر اصلی
                                </button>
                            </form>
                            <form action="{{ route('admin.products.images.destroy', ['product' => $product->id]) }}"
                                  method="POST">
                                @method('DELETE')
                                @csrf
                                <input type="hidden" name="image_id" value="{{ $productImage->id }}">
                                <button class="btn btn-danger mt-2" type="submit">
                                    <i class="bx bx-trash me-1"></i>حذف تصویر از لیست تصاویر
                                </button>
                            </form>
                        </div>
                    @endforeach
                    <hr class="mt-3">
                </div>
                <!-- ردیف افزودن تصویر جدید -->
                <div class="row gx-3 mb-3 mt-3">
                    <label class="mb-1 fw-bolder">* افزودن تصاویر جدید </label>
                    <form action="{{route('admin.products.images.store', ['product' => $product->id])}}"
                          method="POST" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="row gx-3">
                            <div class="form-group col-md-6 mb-2">
                                <div
                                    class="custom-file card-body text-center d-flex flex-column align-items-center">
                                    <input class="custom-file-input" type="file" name="primary_image"
                                           id="primary_image" style="display:none;"/>
                                    <label class="custom-file-label" for="primary_image">
                                        <div class="d-flex justify-content-center align-items-center"
                                             style="width: 150px; height: 150px; overflow: hidden;">
                                            <img class="img-account-profile rounded-circle mb-2"
                                                 src="{{asset('assets/admin/img/illustrations/select_image.png')}}"
                                                 alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    </label>
                                    <div class="small font-italic text-muted mb-4">
                                        فرمت تصویر JPG. یا PNG. <br>
                                        حداکثر سایز 500 کیلوبایت
                                    </div>
                                    <button class="btn btn-light" type="button" disabled>محل آپلود عکس اصلی محصول
                                    </button>
                                </div>
                            </div>
                            <div class="form-group col-md-6 mb-2">
                                <div
                                    class="custom-file card-body text-center d-flex flex-column align-items-center">
                                    <input class="custom-file-input-images" type="file" multiple name="images[]"
                                           id="images" style="display:none;"/>
                                    <label class="custom-file-label-images" for="images">
                                        <div class="d-flex justify-content-center align-items-center"
                                             style="width: 150px; height: 150px; overflow: hidden;">
                                            <img class="img-account-profile rounded-circle mb-2"
                                                 src="{{asset('assets/admin/img/illustrations/select_image.png')}}"
                                                 alt="" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    </label>
                                    <div class="small font-italic text-muted mb-4">
                                        فرمت تصویر JPG. یا PNG. <br>
                                        حداکثر سایز 500 کیلوبایت
                                    </div>
                                    <button class="btn btn-light" type="button" disabled>محل آپلود سایر تصاویر
                                        محصول
                                    </button>
                                </div>
                            </div>
                            <div class="form-group col-md-12 mb-2 d-flex align-items-center justify-content-center">
                                <button class="btn btn-secondary w-100" type="submit">آپلود تصاویر اضافه شده
                                </button>
                            </div>
                        </div>
                        <hr>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('assets/admin/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/defaults-fa_IR.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/jquery.czMore-latest.js')}}"></script>
    <script src="{{asset('assets/admin/js/mds.bs.datetimepicker.js')}}"></script>
    <script src="{{asset('assets/admin/js/sweetalert2.all.min.js')}}"></script>

    <script>

        $("#czContainer").czMore();

        // نمایش نام فایل انتخاب شده
        document.querySelector('.custom-file-input').addEventListener('change', function (e) {

            var fileName = document.getElementById("primary_image").files[0].name;
            console.log(fileName);
            var nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
        });
        // نمایش نام فایل انتخاب شده
        document.querySelector('.custom-file-input-images').addEventListener('change', function (e) {

            // گرفتن لیست فایل‌های آپلود شده
            var fileList = e.target.files;

            fileNames = "";
            // برای دسترسی به نام هر فایل
            for (var i = 0; i < fileList.length; i++) {
                fileNames += fileList[i].name + "\n";
            }

            var nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileNames;
        });

    </script>
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
    </script>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/admin/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/sweetalert2.min.css')}}">
@endsection

