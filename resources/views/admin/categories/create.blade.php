@extends('admin.layouts.master')
@section('title')
    {{ config('app.name') }}-ایجاد دسته بندی‌
@endsection
@section('page-header')
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class='bx bx-category'></i></div>
                            ثبت دسته بندی‌ جدید
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
            <div class="card-header">ایجاد دسته بندی‌
                <a href="{{route('admin.categories.index')}}">
                    <button class="btn btn-sm btn-outline-primary">
                        <i class='bx bxs-grid me-1'></i>
                        نمایش همه دسته بندی‌ها
                    </button>
                </a>
            </div>
            <div class="card-body">
                @include('admin.sections.errors')
                <form method="POST" action="{{ route('admin.categories.store') }}">
                    @csrf
                    <!-- ردیف اول -->
                    <div class="row gx-3 mb-3">
                        <!-- عنوان دسته -->
                        <div class="col-md-3 mb-2">
                            <label class="small mb-1" for="name">نام دسته بندی‌</label>
                            <input class="form-control" id="name" name="name" type="text" value="{{old('name')}}"
                                   placeholder="عنوان دسته">
                        </div>
                        <!-- نام انگلیسی -->
                        <div class="col-md-3 mb-2">
                            <label class="small mb-1" for="slug">نام انگلیسی‌</label>
                            <input class="form-control" id="slug" name="slug" type="text" value="{{old('slug')}}"
                                   placeholder="اسلاگ دسته">
                        </div>
                        <!-- والد -->
                        <div class="col-md-3 mb-2">
                            <label class="small mb-1" for="parent_id">والد (بدون والد همان دسته اصلی)</label>
                            <select class="form-select" id="parent_id" name="parent_id">
                                <option value="0" selected>دسته اصلی</option>
                                @foreach($parentCategories as $parentCategory)
                                    <option value="{{$parentCategory->id}}">{{$parentCategory->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- وضعیت -->
                        <div class="col-md-3 mb-2">
                            <label class="small mb-1" for="is_active">وضعیت دسته بندی‌</label>
                            <select class="form-select" id="is_active" name="is_active">
                                <option value="1" selected>فعال</option>
                                <option value="0">غیر فعال</option>
                            </select>
                        </div>
                    </div>
                    <!-- ردیف دوم -->
                    <div class="row gx-3 mb-3">
                        <!--انتخاب ویژگی -->
                        <div class="col-md-3 mb-2">
                            <label class="small mb-1" for="attributeSelect">ویژگی</label>
                            <select id="attributeSelect" class="form-control" name="attribute_ids[]" multiple
                                    data-selected-text-format="count > 4" data-size="4" data-live-search="true"
                                    data-actions-box="true">
                                @foreach($attributes as $attribute)
                                    <option value="{{$attribute->id}}">{{$attribute->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- انتخاب ویژگی قابل فیلتر -->
                        <div class="col-md-3 mb-2">
                            <label class="small mb-2" for="attributeIsFilterSelect">انتخاب ویژگی‌های قابل فیلتر</label>
                            <select id="attributeIsFilterSelect" class="form-control" name="attribute_is_filter_ids[]"
                                    multiple
                                    data-selected-text-format="count > 4" data-size="4" data-live-search="true"
                                    data-actions-box="true">
                            </select>
                        </div>
                        <!-- انتخاب ویژگی متغییر -->
                        <div class="col-md-3 mb-2">
                            <label class="small mb-2" for="variationSelect">انتخاب ویژگی‌های متغییر</label>
                            <select id="variationSelect" class="form-control show-tick" name="variation_id"
                                    data-size="4" data-live-search="true">
                            </select>
                        </div>
                        <!-- آیکون -->
                        <div class="col-md-3 mb-2">
                            <label class="small mb-1" for="icon">آیکون</label>
                            <input class="form-control" id="icon" name="icon" type="text" value="{{old('icon')}}"
                                   placeholder="آیکون (اختیاری)">
                        </div>
                    </div>
                    <!-- ردیف سوم و توضیحات -->
                    <div class="row gx-3 mb-3">
                        <!-- توضیحات -->
                        <div class="col-md-12 mb-2">
                            <label class="small mb-1" for="description">توضیحات‌</label>
                            <textarea class="form-control" id="description" name="description" rows="5"
                                      placeholder="توضیحات (اختیاری)">{{old('description')}}</textarea>
                        </div>
                    </div>
                    <div class="">
                        <button class="btn btn-primary me-2 w-25" type="submit">ذخیره</button>
                        <a href="{{route('admin.categories.index')}}">
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
    <script>
        $('#attributeSelect').selectpicker({
            title: 'انتخاب ویژگی‌',
        });
        $('#attributeSelect').on('changed.bs.select', function () {
            let attributeSelected = $(this).val(); // get from client
            let attributes = @json($attributes); // get from server

            let attributeForFilter = [];
            attributes.map((attribute) => {
                $.each(attributeSelected, function (key, value) {
                    if (attribute.id == value) { // check if attribute is selected
                        attributeForFilter.push(attribute);
                    }
                });
            });


            // remove all options in #attributeIsFilterSelect
            $('#attributeIsFilterSelect').find('option').remove();
            $('#variationSelect').find('option').remove();
            attributeForFilter.forEach((element) => {
                // two variables for each option => bug in selectpicker
                let filterOption = $("<option />", {
                    value: element.id,
                    text: element.name
                });
                let variationOption = $("<option />", {
                    value: element.id,
                    text: element.name
                });
                $("#attributeIsFilterSelect").append(filterOption);
                $("#variationSelect").append(variationOption);
                $('#attributeIsFilterSelect').selectpicker('refresh');
                $('#variationSelect').selectpicker('refresh');
            });
        });

        $('#attributeIsFilterSelect').selectpicker({
            title: 'ویژگی‌های قابل فیلتر',
        });
        $('#variationSelect').selectpicker({
            title: 'ویژگی‌های متغییر',
        });
    </script>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('assets/admin/css/bootstrap-select.min.css')}}">
@endsection

