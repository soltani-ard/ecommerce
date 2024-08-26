@extends('admin.layouts.master')
@section('title')
    {{ config('app.name') }}-ایجاد محصول
@endsection
@section('page-header')
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class='bx bx-store'></i></div>
                            ثبت محصول جدید
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
            <div class="card-header">ایجاد محصول
                <a href="{{route('admin.products.index')}}">
                    <button class="btn btn-sm btn-outline-primary">
                        <i class='bx bxs-grid me-1'></i>
                        نمایش همه محصولات
                    </button>
                </a>
            </div>
            <div class="card-body">
                @include('admin.sections.errors')
                <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                    @csrf
                    <!-- ردیف اول -->
                    <div class="row gx-3 mb-3">
                        <!-- نام محصول -->
                        <div class="col-md-4">
                            <label class="small mb-1" for="name">نام محصول </label>
                            <input class="form-control" id="name" name="name" type="text" value="{{old('name')}}"
                                   placeholder="نام محصول خود را وارد کنید">
                        </div>
                        <!-- برند -->
                        <div class="col-md-2 mb-2">
                            <label class="small mb-1" for="brandSelect">انتخاب برند</label>
                            <select id="brandSelect" class="form-control" name="brand_id"
                                    data-selected-text-format="count > 4" data-size="4" data-live-search="true">
                                @foreach($brands as $brand)
                                    <option value="{{$brand->id}}" {{old('brand_id') == $brand->id ? 'selected' : ''}}>{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- وضعیت -->
                        <div class="col-md-2 mb-2">
                            <label class="small mb-1" for="is_active">وضعیت محصول‌</label>
                            <select class="form-select" id="is_active" name="is_active">
                                <option value="1" {{old('is_active') == 1 ? 'selected' : ''}}>فعال</option>
                                <option value="0" {{old('is_active') == 0 ? 'selected' : ''}}>غیر فعال</option>
                            </select>
                        </div>

                        <!-- تگ -->
                        <div class="col-md-3 mb-2">
                            <label class="small mb-1" for="tagSelect">انتخاب برچسب</label>
                            <select id="tagSelect" class="form-control" name="tag_ids[]" multiple
                                    data-selected-text-format="count > 4" data-size="4" data-live-search="true"
                                    data-actions-box="true">

                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}" {{ collect(old('tag_ids', []))->contains($tag->id) ? 'selected' : '' }}>{{$tag->name}}</option>
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
                                      placeholder="توضیحات">{{old('description')}}</textarea>
                        </div>
                    </div>
                    <!-- ردیف سوم انتخاب تصویر -->
                    <div class="row gx-3 mb-3">
                        <div class="form-group col-md-3 mb-2">
                            <label for="primary_image" class="small mb-1">انتخاب تصویر اصلی</label>
                            <div class="custom-file card-body text-center">
                                <input class="custom-file-input" type="file" name="primary_image" id="primary_image"
                                       style="display:none;"/>
                                <label class="custom-file-label" for="primary_image">
                                    <img class="img-account-profile rounded-circle mb-2" src="{{asset('assets/admin/img/illustrations/select_image.png')}}" alt="">
                                </label>
                                <div class="small font-italic text-muted mb-4">
                                    فرمت تصویر JPG. یا PNG. <br>
                                    حداکثر سایز 500 کیلوبایت
                                </div>
                                <button class="btn btn-primary" type="button">آپلود عکس جدید</button>
                            </div>
                        </div>
                        <div class="form-group col-md-3 mb-2">
                            <label for="images" class="small mb-1">انتخاب تصویر </label>
                            <div class="custom-file card-body text-center">
                                <input class="custom-file-input-images" type="file" multiple name="images[]" id="images"
                                       style="display:none;"/>
                                <label class="custom-file-label-images" for="images">
                                    <img class="img-account-profile rounded-circle mb-2" src="{{asset('assets/admin/img/illustrations/select_image.png')}}" alt="">
                                </label>
                                <div class="small font-italic text-muted mb-4">
                                    فرمت تصویر JPG. یا PNG. <br>
                                    حداکثر سایز 500 کیلوبایت
                                </div>
                                <button class="btn btn-primary" type="button">آپلود عکس جدید</button>
                            </div>
                        </div>
                    </div>
                    <!-- ردیف چهارم دسته بندی -->
                    <div class="row gx-3 mb-3">
                        <div class="col-md-4 mb-2">
                            <label class="small mb-1" for="categorySelect">انتخاب دسته بندی</label>
                            <select id="categorySelect" class="form-control" name="category_id"
                                    data-selected-text-format="count > 4" data-size="4" data-live-search="true">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{$category->name}} - {{$category->parent->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- ردیف پنجم ویژگی‌ها -->
                    <div class="row gx-3 mb-3" id="attributesSection">
                    </div>
                    <!-- ردیف ششم ویژگی‌های متغییر -->
                    <div class="row gx-3 mb-3" id="variationSection">
                        <label class="mb-1" for="description">افزودن قیمت و موجودی برای <span class="fw-bolder  text-medium text-blue" id="variationName"></span> : </label>
                        <div id="czContainer">
                            <div id="first">
                                <div class="recordset">
                                    <div class="row mb-2">
                                        <!-- مقدار -->
                                        <div class="col-md-1">
                                            <label class="small mb-1" for="value">مقدار</label>
                                            <input class="form-control" id="value" name="variation_values[value][]" type="text">
                                        </div>
                                        <!-- قیمت -->
                                        <div class="col-md-2">
                                            <label class="small mb-1" for="price">قیمت</label>
                                            <input class="form-control" id="price" name="variation_values[price][]" type="text">
                                        </div>
                                        <!-- تعداد -->
                                        <div class="col-md-1">
                                            <label class="small mb-1" for="quantity">تعداد</label>
                                            <input class="form-control" id="quantity" name="variation_values[quantity][]" type="text">
                                        </div>
                                        <!-- شناسه انبار -->
                                        <div class="col-md-2">
                                            <label class="small mb-1" for="sku">شناسه انبار</label>
                                            <input class="form-control" id="sku" name="variation_values[sku][]" type="text">
                                        </div>
                                        <!-- قیمت حراج -->
                                        <div class="col-md-2">
                                            <label class="small mb-1" for="sale_price">قیمت حراج</label>
                                            <input class="form-control" id="sale_price" name="variation_values[sale_price][]" type="text">
                                        </div>
                                        <!-- تاریخ شروع -->
                                        <div class="col-md-2">
                                            <label class="small mb-1" for="date_on_sale_from">تاریخ شروع</label>
                                            <input class="form-control" id="date_on_sale_from" data-name="date_on_sale_from" name="variation_values[date_on_sale_from][]" type="text">
                                        </div>
                                        <!-- تاریخ پایان -->
                                        <div class="col-md-2">
                                            <label class="small mb-1" for="date_on_sale_to">تاریخ پابان</label>
                                            <input class="form-control" id="date_on_sale_to" data-name="date_on_sale_to" name="variation_values[date_on_sale_to][]" type="text">
                                        </div>
                                        <hr class="mt-3">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ردیف هفتم هزینه ارسال -->
                    <div class="row gx-3 mb-3" >
                        <!-- هزینه ارسال -->
                        <div class="col-md-4">
                            <label class="small mb-1" for="delivery_amount">هزینه ارسال</label>
                            <input class="form-control" id="delivery_amount" name="delivery_amount" type="text" value="{{old('delivery_amount')}}">
                        </div>
                        <!-- هزینه ارسال به ازای محصول اضافی -->
                        <div class="col-md-4">
                            <label class="small mb-1" for="delivery_amount_per_product">هزینه ارسال به ازای محصول اضافی</label>
                            <input class="form-control" id="delivery_amount_per_product" name="delivery_amount_per_product" type="text" value="{{old('delivery_amount_per_product')}}">
                        </div>
                    </div>
                    <!-- ارسال فرم -->
                    <div class="">
                        <button class="btn btn-primary me-2 w-25" type="submit">ذخیره</button>
                        <a href="{{route('admin.products.index')}}">
                            <button id="alert-button" class="btn btn-light w-25" type="button">انصراف</button>
                        </a>
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
    <script>
        $('#brandSelect').selectpicker({
            title: 'انتخاب برند',
        });
        $('#tagSelect').selectpicker({
            title: 'انتخاب برچسب',
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
        $('#categorySelect').selectpicker({
            title: 'انتخاب دسته‌بندی',
        });
        $('#attributesSection').hide();
        $('#variationSection').hide();
        $('#categorySelect').on('changed.bs.select', function () {

            let categoryId = $(this).val(); // get from client
            let url = `{{ url('/admin-panel/management/category-attributes') }}/${categoryId}`;
            $.get(url, function (response, status) {
                if(status === 'success') {
                    $('#attributesSection').fadeIn();
                    $('#variationSection').fadeIn();
                    $('#attributesSection').empty();
                    response.attributes.forEach(function (attribute) {
                        let attributeGroup = $('<div/>', {
                            class: 'col-md-2 mb-2',
                        });
                        let label = $('<label/>', {
                            text: attribute.name,
                        });
                        let input = $('<input/>', {
                            class: 'form-control',
                            id: 'name',
                            name: `attribute_ids[${attribute.id}]`,
                            type: 'text',
                            text: attribute.name,
                        });
                        attributeGroup.append(label);
                        attributeGroup.append(input);
                        $('#attributesSection').append(attributeGroup);
                    });
                    $('#variationName').text(response.variation.name);
                } else {
                    console.log(response);
                }
            }).fail(function () {
                alert('مشکل در دریافت لیست ویژگی‌ها رخ داده است');
            })
        });
    </script>
    <script>
        $(document).ready(function () {
            // شمارنده برای منحصر به فرد کردن ID ها
            var counter = 0;

            // تنظیم کتابخانه czMore
            $("#czContainer").czMore({
                onAdd: function () {
                    // تولید ID های منحصر به فرد
                    $('#czContainer .recordset:last').find('input[name="variation_values[date_on_sale_from][]"]').attr('id', 'date_on_sale_from_' + counter);
                    $('#czContainer .recordset:last').find('input[name="variation_values[date_on_sale_from][]"]').attr('data-name', 'date_on_sale_from_' + counter);
                    const dtpFrom = new mds.MdsPersianDateTimePicker(document.getElementById('date_on_sale_from_' + counter), {
                        targetTextSelector: `[data-name="date_on_sale_from_${counter}"]`,
                        enableTimePicker: true,
                        textFormat: 'yyyy-MM-dd HH:mm:ss'
                    });

                    $('#czContainer .recordset:last').find('input[name="variation_values[date_on_sale_to][]"]').attr('id', 'date_on_sale_to_' + counter);
                    $('#czContainer .recordset:last').find('input[name="variation_values[date_on_sale_to][]"]').attr('data-name', 'date_on_sale_to_' + counter);
                    const dtpTo = new mds.MdsPersianDateTimePicker(document.getElementById('date_on_sale_to_' + counter), {
                        targetTextSelector: `[data-name="date_on_sale_to_${counter}"]`,
                        enableTimePicker: true,
                        textFormat: 'yyyy-MM-dd HH:mm:ss'
                    });
                    // افزایش شمارنده
                    counter++;
                }
            });
        });


    </script>

@endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/admin/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/mds.bs.datetimepicker.style.css')}}">
@endsection

