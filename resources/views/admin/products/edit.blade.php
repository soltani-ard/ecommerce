@extends('admin.layouts.master')
@section('title')
    {{ config('app.name') }}-ویرایش محصول
@endsection
@section('page-header')
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class='bx bx-pencil'></i></div>
                            ویرایش محصول
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
            <div class="card-header"> ویرایش محصول : {{$product->name}}
                <a href="{{route('admin.products.index')}}">
                    <button class="btn btn-sm btn-outline-primary">
                        <i class='bx bxs-grid me-1'></i>
                        نمایش همه محصولات
                    </button>
                </a>
            </div>
            <div class="card-body">
                @include('admin.sections.errors')
                <form method="POST" action="{{ route('admin.products.update', ['product' => $product->id]) }}">
                    @csrf
                    @method('PUT')
                    <!-- ردیف اول -->
                    <div class="row gx-3 mb-3">
                        <!-- نام محصول -->
                        <div class="col-md-4">
                            <label class="small mb-1" for="name">نام محصول </label>
                            <input class="form-control" id="name" name="name" type="text" value="{{$product->name}}"
                                   placeholder="نام محصول خود را وارد کنید">
                        </div>
                        <!-- برند -->
                        <div class="col-md-2 mb-2">
                            <label class="small mb-1" for="brandSelect">انتخاب برند</label>
                            <select id="brandSelect" class="form-control" name="brand_id"
                                    data-selected-text-format="count > 4" data-size="4" data-live-search="true">
                                @foreach($brands as $brand)
                                    <option value="{{$brand->id}}" {{$product->brand_id == $brand->id ? 'selected' : ''}}>{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- وضعیت -->
                        <div class="col-md-2 mb-2">
                            <label class="small mb-1" for="is_active">وضعیت محصول‌</label>
                            <select class="form-select" id="is_active" name="is_active">
                                <option value="1" {{$product->getRawOriginal('is_active') == 1 ? 'selected' : ''}}>فعال</option>
                                <option value="0" {{$product->getRawOriginal('is_active') == 0 ? 'selected' : ''}}>غیر فعال</option>
                            </select>
                        </div>
                        <!-- تگ -->
                        <div class="col-md-3 mb-2">
                            <label class="small mb-1" for="tagSelect">انتخاب برچسب</label>
                            <select id="tagSelect" class="form-control" name="tag_ids[]" multiple
                                    data-selected-text-format="count > 4" data-size="4" data-live-search="true"
                                    data-actions-box="true">

                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}" @if($product->tags->contains($tag->id)) selected @endif >{{$tag->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- ردیف دوم و توضیحات -->
                    <div class="row gx-3 mb-3">
                        <!-- توضیحات -->
                        <div class="col-md-12 mb-2">
                            <label class="small mb-1" for="description">توضیحات‌</label>
                            <textarea class="form-control" id="description" name="description" rows="5"
                                      placeholder="توضیحات (اختیاری)">{{$product->description}}</textarea>
                        </div>
                        <hr class="mt-3">
                    </div>
                    <!-- ردیف سوم ویژگی‌ها -->
                    <div class="row gx-3 mb-3" id="oldAttributes">
                        <label class="mb-1 mb-3 fw-bolder">* ویژگی‌ها </label>
                        @foreach($productAttributes as $productAttribute)
                            <div class="col-md-2">
                                <label class="small mb-1">{{$productAttribute->attribute->name}}</label>
                                <input class="form-control" type="text" value="{{$productAttribute->value}}" name="attribute_values[{{$productAttribute->attribute_id}}]">
                            </div>
                        @endforeach
                        <label class="mb-1 mt-3 fw-bolder">* ویژگی‌های متغییر </label>
                        @foreach($productVariations as $productVariation)
                            <div class="accordion accordion-flush" id="accordion{{$loop->index}}">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{$loop->index}}">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$loop->index}}" aria-expanded="true" aria-controls="collapse{{$loop->index}}">
                                            <div class="text-sm fw-normal">قیمت و موجودی برای متغییر <span class="badge bg-primary text-md">{{$productVariation->value}}</span></div>

                                        </button>
                                    </h2>
                                    <div id="collapse{{$loop->index}}" class="accordion-collapse collapse" aria-labelledby="heading{{$loop->index}}" data-bs-parent="#accordion{{$loop->index}}">
                                        <div class="accordion-body">
                                            <div class="row gx-3 mb-3">
                                                <label class="mb-1 mb-3 fw-bolder">* اطلاعات اولیه </label>
                                                <div class="col-md-2">
                                                    <label class="small mb-1">قیمت عادی</label>
                                                    <input class="form-control" type="text" value="{{$productVariation->price}}" name="variation_values[{{$productVariation->id}}][price]">
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="small mb-1">موجودی</label>
                                                    <input class="form-control" type="text" value="{{$productVariation->quantity}}" name="variation_values[{{$productVariation->id}}][quantity]">
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="small mb-1">شناسه انبار</label>
                                                    <input class="form-control" type="text" value="{{$productVariation->sku}}" name="variation_values[{{$productVariation->id}}][sku]">
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="small mb-1">قیمت حراج</label>
                                                    <input class="form-control" type="text" value="{{$productVariation->sale_price}}" name="variation_values[{{$productVariation->id}}][sale_price]">
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="small mb-1">تاریخ شروع حراج</label>
                                                    <input class="form-control" type="text" data-name="date_on_sale_from-{{$productVariation->id}}" id="date_on_sale_from-{{$productVariation->id}}" value="{{$productVariation->date_on_sale_from == null ? null : verta($productVariation->date_on_sale_from)}}" name="variation_values[{{$productVariation->id}}][date_on_sale_from]">
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="small mb-1">تاریخ پایان حراج</label>
                                                    <input class="form-control" type="text" data-name="date_on_sale_to-{{$productVariation->id}}" id="date_on_sale_to-{{$productVariation->id}}" value="{{$productVariation->date_on_sale_to == null ? null : verta($productVariation->date_on_sale_to)}}" name="variation_values[{{$productVariation->id}}][date_on_sale_to]">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <hr class="mt-3">
                    </div>
                    <!-- ردیف چهارم هزینه ارسال -->
                    <div class="row gx-3 mb-3" >
                        <label class="mb-1 mb-3 fw-bolder">* هزینه پستی </label>
                        <!-- هزینه ارسال -->
                        <div class="col-md-4">
                            <label class="small mb-1" for="delivery_amount">هزینه ارسال</label>
                            <input class="form-control" id="delivery_amount" name="delivery_amount" type="text" value="{{$product->delivery_amount}}">
                        </div>
                        <!-- هزینه ارسال به ازای محصول اضافی -->
                        <div class="col-md-4">
                            <label class="small mb-1" for="delivery_amount_per_product">هزینه ارسال به ازای محصول اضافی</label>
                            <input class="form-control" id="delivery_amount_per_product" name="delivery_amount_per_product" type="text" value="{{$product->delivery_amount_per_product}}">
                        </div>
                        <hr class="mt-5 mb-3">
                    </div>
                    <div class="">
                        <button class="btn btn-primary me-2 w-25" type="submit">ویرایش</button>
                        <a href="{{route('admin.products.index')}}"> <button id="alert-button" class="btn btn-light w-25" type="button">انصراف</button></a>
                    </div>
                </form>
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
        $('#brandSelect').selectpicker({
            title: 'انتخاب برند',
        });
        $('#tagSelect').selectpicker({
            title: 'انتخاب برچسب',
        });
        $('#categorySelect').selectpicker({
            title: 'انتخاب دسته‌بندی',
        });
        $("#czContainer").czMore();

         let variations = @json($productVariations);
         variations.forEach(variation => {
             const dtpFrom = new mds.MdsPersianDateTimePicker(document.getElementById(`date_on_sale_from-${variation.id}`), {
                 targetTextSelector: `[data-name="date_on_sale_from-${variation.id}"]`,
                 selectedDate: variation.date_on_sale_from == null ? null : new Date(variation.date_on_sale_from),
                 enableTimePicker: true,
                 textFormat: 'yyyy-MM-dd HH:mm:ss'
             });
             const dtpTo = new mds.MdsPersianDateTimePicker(document.getElementById(`date_on_sale_to-${variation.id}`), {
                 targetTextSelector: `[data-name="date_on_sale_to-${variation.id}"]`,
                 enableTimePicker: true,
                 selectedDate: variation.date_on_sale_to == null ? null : new Date(variation.date_on_sale_to),
                 textFormat: 'yyyy-MM-dd HH:mm:ss'
             });
         });

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
    <link rel="stylesheet" href="{{asset('assets/admin/css/mds.bs.datetimepicker.style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/sweetalert2.min.css')}}">
@endsection

