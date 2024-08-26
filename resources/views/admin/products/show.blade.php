@extends('admin.layouts.master')
@section('title')
    {{ config('app.name') }}-نمایش محصول
@endsection
@section('page-header')
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class='bx bx-store'></i></div>
                            نمایش محصول
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
            <div class="card-header"> محصول  : {{$product->name}}
            </div>
            <div class="card-body">
                <!-- ردیف اول -->
                <div class="row gx-3 mb-3">
                    <label class="mb-1 mb-3 fw-bolder" for="description">* اطلاعات اولیه محصول </label>
                    <div class="col-md-3">
                        <label class="small mb-1">نام محصول </label>
                        <input class="form-control" type="text" value="{{$product->name}}" disabled>
                    </div>
                    <div class="col-md-2">
                        <label class="small mb-1">نام برند </label>
                        <input class="form-control" type="text" value="{{$product->brand->name}}" disabled>
                    </div>
                    <div class="col-md-2">
                        <label class="small mb-1">دسته‌بندی</label>
                        <input class="form-control" type="text" value="{{$product->category->name}}" disabled>
                    </div>
                    <div class="col-md-1">
                        <label class="small mb-1">وضعیت</label>
                        <input class="form-control" type="text" value="{{$product->is_active}}" disabled>
                    </div>
                    <div class="col-md-2">
                        <label class="small mb-1"> تاریخ ایجاد محصول</label>
                        <input class="form-control" type="text" value="{{verta($product->created_at)->format('Y-n-j')}}" disabled>
                    </div>
                    <div class="col-md-2">
                        <label class="small mb-1">تاریخ آخرین ویرایش</label>
                        <input class="form-control" type="text" value="{{verta($product->updated_at)->format('Y-n-j')}}" disabled>
                    </div>
                </div>
                <!-- ردیف دوم توضیحات -->
                <div class="row gx-3 mb-1">
                    <div class="col-md-12 mb-3">
                        <label class="small mb-1">توضیحات</label>
                        <textarea class="form-control" rows="5" disabled>{{$product->description}}</textarea>
                    </div>
                    <hr>
                </div>
                <!-- ردیف سوم هزینه ارسال -->
                <div class="row gx-3 mb-1">
                    <label class="mb-1 mb-3 fw-bolder">* هزینه ارسال </label>
                    <div class="col-md-2">
                        <label class="small mb-1">هزینه ارسال</label>
                        <input class="form-control" type="text" value="{{$product->delivery_amount}}" disabled>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="small mb-1"> هزینه ارسال برای محصول اضافی</label>
                        <input class="form-control" type="text" value="{{$product->delivery_amount_per_product}}" disabled>
                    </div>
                    <hr/>
                </div>
                <!-- ردیف چهارم تعداد موجودی -->
                <div class="row gx-3 mb-3">
                    <label class="mb-1 mb-3 fw-bolder">* ویژگی‌ها </label>
                @foreach($productAttributes as $productAttribute)
                        <div class="col-md-2">
                            <label class="small mb-1">{{$productAttribute->attribute->name}}</label>
                            <input class="form-control" type="text" value="{{$productAttribute->value}}" disabled>
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
                                                <input class="form-control" type="text" value="{{$productVariation->price}}" disabled>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="small mb-1">موجودی</label>
                                                <input class="form-control" type="text" value="{{$productVariation->quantity}}" disabled>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="small mb-1">شناسه انبار</label>
                                                <input class="form-control" type="text" value="{{$productVariation->sku}}" disabled>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="small mb-1">قیمت حراج</label>
                                                <input class="form-control" type="text" value="{{$productVariation->sale_price}}" disabled>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="small mb-1">تاریخ شروع حراج</label>
                                                <input class="form-control" type="text" value="{{$productVariation->date_on_sale_from == null ? null : verta($productVariation->date_on_sale_from)}}" disabled>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="small mb-1">تاریخ پایان حراج</label>
                                                <input class="form-control" type="text" value="{{$productVariation->date_on_sale_to == null ? null : verta($productVariation->date_on_sale_to)}}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <hr>
                    <div class="row gx-3 mb-3">
                        <label class="mb-1 mb-3 fw-bolder">* تصویر اصلی </label>
                        <div class="col-md-3">
                            <img class="img-fluid rounded-3" src="{{url(env('PRODUCT_IMAGES_PATH').$product->primary_image)}}" alt="{{$product->name}}" width="200">
                        </div>
                        <hr class="mt-3 mb-3">
                        <label class="mb-1 mb-3 fw-bolder">* سایر تصاویر </label>
                        @foreach($productImages as $productImage)
                            <div class="col-md-3">
                                <img class="img-fluid rounded-3" src="{{url(env('PRODUCT_IMAGES_PATH').$productImage->image)}}" alt="{{$product->name}}" width="200">

                            </div>
                        @endforeach
                    </div>
                    <hr class="mt-3">
                </div>
                <div class="">
                   <a href="{{route('admin.products.index')}}"> <button id="alert-button" class="btn btn-light w-25" type="button">بازگشت</button></a>
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
