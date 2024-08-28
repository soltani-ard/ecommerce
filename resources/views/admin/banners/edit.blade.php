@extends('admin.layouts.master')
@section('title')
    {{ config('app.name') }}-ایجاد بنر
@endsection
@section('page-header')
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class='bx bx-image'></i></div>
                            ویرایش بنر
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
            <div class="card-header">ویرایش بنر {{$banner->title}}
                <a href="{{route('admin.banners.index')}}">
                    <button class="btn btn-sm btn-outline-primary">
                        <i class='bx bxs-grid me-1'></i>
                        نمایش همه بنر ها
                    </button>
                </a>
            </div>
            <div class="card-body">
                @include('admin.sections.errors')
                <form method="POST" action="{{ route('admin.banners.update', ['banner' => $banner->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- ردیف اول -->
                    <div class="row gx-3 mb-3">
                        <!-- عنوان بنر -->
                        <div class="col-md-4">
                            <label class="small mb-1" for="title">عنوان بنر </label>
                            <input class="form-control" id="title" name="title" type="text" value="{{$banner->title}}"
                                   placeholder="عنوان بنر خود را وارد کنید">
                        </div>
                        <!-- متن دکمه -->
                        <div class="col-md-2">
                            <label class="small mb-1" for="button_text">متن دکمه</label>
                            <input class="form-control" id="button_text" name="button_text" type="text" value="{{$banner->button_text}}"
                                   placeholder="متن دکمه خود را وارد کنید">
                        </div>
                        <!-- لینک دکمه -->
                        <div class="col-md-2">
                            <label class="small mb-1" for="button_link">لینک دکمه</label>
                            <input class="form-control" id="button_link" name="button_link" type="text" value="{{$banner->button_link}}"
                                   placeholder="لینک دکمه خود را وارد کنید">
                        </div>
                        <!-- آیکون دکمه -->
                        <div class="col-md-2">
                            <label class="small mb-1" for="button_icon">آیکون دکمه</label>
                            <input class="form-control" id="button_icon" name="button_icon" type="text" value="{{$banner->button_icon}}"
                                   placeholder="آیکون دکمه خود را وارد کنید">
                        </div>
                    </div>
                    <!-- ردیف دوم -->
                    <div class="row gx-3 mb-3">
                        <!-- نوع بنر -->
                        <div class="col-md-2">
                            <label class="small mb-1" for="type">نوع بنر</label>
                            <input class="form-control" id="type" name="type" type="text" value="{{$banner->type}}"
                                   placeholder="نوع بنر خود را وارد کنید">
                        </div>
                        <!-- اولویت -->
                        <div class="col-md-2">
                            <label class="small mb-1" for="priority">اولویت</label>
                            <input class="form-control" id="priority" name="priority" type="number" min="0"  value="{{$banner->priority}}"
                                   placeholder="اولویت خود را وارد کنید">
                        </div>
                        <!-- وضعیت بنر -->
                        <div class="col-md-2">
                            <label class="small mb-1" for="is_active">وضعیت بنر</label>
                            <select class="form-select" id="is_active" name="is_active">
                                <option value="1" {{$banner->getRawOriginal('is_active') == 1 ? 'selected' : ''}}>فعال</option>
                                <option value="0" {{$banner->getRawOriginal('is_active') == 0 ? 'selected' : ''}}>غیر فعال</option>
                            </select>
                        </div>
                    </div>
                    <!-- ردیف سوم -->
                    <div class="row gx-3 mb-3">
                        <!-- توضیحات -->
                        <div class="col-md-12 mb-2">
                            <label class="small mb-1" for="text">توضیحات بنر‌</label>
                            <textarea class="form-control" id="text" name="text" rows="5"
                                      placeholder="توضیحات">{{$banner->text}}</textarea>
                        </div>
                    </div>
                    <!-- ردیف چهارم -->
                    <div class="row gx-3 mb-3">
                        <!-- تصویر قبلی -->
                        <div class="form-group col-md-5 mb-2 text-center">
                            <label for="banner_image" class="small mb-1">تصویر قبلی</label>
                            <div class="d-flex justify-content-center align-items-center" style="height: 350px;">
                                <img class="img-fluid rounded" src="{{url(env('BANNER_IMAGES_PATH').$banner->image)}}" alt="{{$banner->title}}" style="max-height: 100%; max-width: 100%;">
                            </div>
                        </div>
                        <!-- آپلود تصویر جدید -->
                        <div class="form-group col-md-4 mb-2 text-center">
                            <label for="banner_image" class="small mb-1">  انتخاب تصویر جدید (اختیاری)</label>
                            <div class="custom-file card-body text-center">
                                <input class="custom-file-input" type="file" name="banner_image" id="banner_image" style="display:none;" onchange="loadFile(event)"/>
                                <label class="custom-file-label" for="banner_image">
                                    <div class="d-flex justify-content-center align-items-center" style="height: 200px;">
                                        <img id="output" class="img-fluid" src="{{asset('assets/admin/img/illustrations/select_image.png')}}" alt="" style="max-height: 100%; max-width: 100%;">
                                    </div>
                                </label>
                                <div class="small font-italic text-muted mb-4">
                                    فرمت تصویر JPG. یا PNG. <br>
                                    حداکثر سایز 500 کیلوبایت
                                </div>
                                <button class="btn btn-link" type="button" onclick="document.getElementById('banner_image').click();">آپلود عکس جدید</button>
                            </div>
                        </div>
                    </div>


                    <div class="">
                        <button class="btn btn-primary me-2 w-25" type="submit">ویرایش</button>
                        <a href="{{route('admin.banners.index')}}"> <button id="alert-button" class="btn btn-light w-25" type="button">انصراف</button></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
@endsection


