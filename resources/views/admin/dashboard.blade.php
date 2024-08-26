@extends('admin.layouts.master')
@section('title') {{ config('app.name') }}-داشبورد@endsection

@section('styles')

@endsection

@section('content')
    <div class="row">
        <div class="col-xxl-4 col-xl-12 mb-4">
            <div class="card h-100">
                <div class="card-body h-100 p-5">
                    <div class="row align-items-center">
                        <div class="col-xl-8 col-xxl-12">
                            <div class="text-center text-xl-start text-xxl-center mb-4 mb-xl-0 mb-xxl-4">
                                <h1 class="text-primary">خوش آمدید به داشبورد حرفه ای!</h1>
                                <p class="text-gray-700 mb-0">اینجا برای شما کلی المان ها و طراحی های حرفه ای تدارک دیده
                                    ایم نمونه ها مشاهده کنید لذت ببرید. در صورت رضایت نسخه اصلی آن را از راستچین خریداری
                                    نمایید.</p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-xxl-12 text-center"><img class="img-fluid"
                                                                          src="{{asset('assets/admin/img/illustrations/at-work.svg')}}"
                                                                          style="max-width: 26rem"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-xl-6 mb-4">
            <div class="card card-header-actions h-100">
                <div class="card-header">
                    آخرین فعالیت
                    <div class="dropdown no-caret">
                        <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="dropdownMenuButton1"
                                type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-more-vertical text-gray-500">
                                <circle cx="12" cy="12" r="1"></circle>
                                <circle cx="12" cy="5" r="1"></circle>
                                <circle cx="12" cy="19" r="1"></circle>
                            </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end animated--fade-in-up"
                             aria-labelledby="dropdownMenuButton1">
                            <h6 class="dropdown-header">فیلتر فعالیت:</h6>
                            <a class="dropdown-item" href="#!"><span
                                    class="badge bg-green-soft text-green my-1">تجاری</span></a>
                            <a class="dropdown-item" href="#!"><span
                                    class="badge bg-blue-soft text-blue my-1">گزارش</span></a>
                            <a class="dropdown-item" href="#!"><span
                                    class="badge bg-yellow-soft text-yellow my-1">سرور</span></a>
                            <a class="dropdown-item" href="#!"><span class="badge bg-purple-soft text-purple my-1">کاربران</span></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="timeline timeline-xs">
                        <!-- Timeline Item 1-->
                        <div class="timeline-item">
                            <div class="timeline-item-marker">
                                <div class="timeline-item-marker-text">27 دقیقه</div>
                                <div class="timeline-item-marker-indicator bg-green"></div>
                            </div>
                            <div class="timeline-item-content">
                                یک سفارش جدید!
                                <a class="fw-bold text-dark" href="#!">شناسه #2912</a>
                                با موفقیت ثبت شده است.
                            </div>
                        </div>
                        <!-- Timeline Item 2-->
                        <div class="timeline-item">
                            <div class="timeline-item-marker">
                                <div class="timeline-item-marker-text">58 دقیقه</div>
                                <div class="timeline-item-marker-indicator bg-blue"></div>
                            </div>
                            <div class="timeline-item-content">
                                شما
                                <a class="fw-bold text-dark" href="#!">گزارش هفتگی</a>
                                یک ایمیل تبلیغاتی دریافت کردید.
                            </div>
                        </div>
                        <!-- Timeline Item 3-->
                        <div class="timeline-item">
                            <div class="timeline-item-marker">
                                <div class="timeline-item-marker-text">2 ساعت</div>
                                <div class="timeline-item-marker-indicator bg-purple"></div>
                            </div>
                            <div class="timeline-item-content">
                                کاربر جدید
                                <a class="fw-bold text-dark" href="#!">مرجان گلرخی</a>
                                ثبت نام شده است.
                            </div>
                        </div>
                        <!-- Timeline Item 4-->
                        <div class="timeline-item">
                            <div class="timeline-item-marker">
                                <div class="timeline-item-marker-text">1 روز</div>
                                <div class="timeline-item-marker-indicator bg-yellow"></div>
                            </div>
                            <div class="timeline-item-content">یک هشدار امنیتی در سرور رخ داده است</div>
                        </div>
                        <!-- Timeline Item 5-->
                        <div class="timeline-item">
                            <div class="timeline-item-marker">
                                <div class="timeline-item-marker-text">1 روز</div>
                                <div class="timeline-item-marker-indicator bg-green"></div>
                            </div>
                            <div class="timeline-item-content">
                                یک سفارش جدید!
                                <a class="fw-bold text-dark" href="#!">شناسه #2911</a>
                                با موفقیت ثبت شده است.
                            </div>
                        </div>
                        <!-- Timeline Item 6-->
                        <div class="timeline-item">
                            <div class="timeline-item-marker">
                                <div class="timeline-item-marker-text">1 روز</div>
                                <div class="timeline-item-marker-indicator bg-purple"></div>
                            </div>
                            <div class="timeline-item-content">
                                مشخصات
                                <a class="fw-bold text-dark" href="#!">کمپین بازاریابی ایمیلی</a>
                                بروز رسانی شد.
                            </div>
                        </div>
                        <!-- Timeline Item 7-->
                        <div class="timeline-item">
                            <div class="timeline-item-marker">
                                <div class="timeline-item-marker-text">2 روز</div>
                                <div class="timeline-item-marker-indicator bg-green"></div>
                            </div>
                            <div class="timeline-item-content">
                                یک سفارش جدید!
                                <a class="fw-bold text-dark" href="#!">شناسه #2910</a>
                                با موفقیت ثبت شده است.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-xl-6 mb-4">
            <div class="card card-header-actions h-100">
                <div class="card-header">
                    وظایف در حال اجرا
                    <div class="dropdown no-caret">
                        <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="dropdownMenuButton"
                                type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="feather feather-more-vertical text-gray-500">
                                <circle cx="12" cy="12" r="1"></circle>
                                <circle cx="12" cy="5" r="1"></circle>
                                <circle cx="12" cy="19" r="1"></circle>
                            </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end animated--fade-in-up"
                             aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#!">
                                <div class="dropdown-item-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-list text-gray-500">
                                        <line x1="8" y1="6" x2="21" y2="6"></line>
                                        <line x1="8" y1="12" x2="21" y2="12"></line>
                                        <line x1="8" y1="18" x2="21" y2="18"></line>
                                        <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                        <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                        <line x1="3" y1="18" x2="3.01" y2="18"></line>
                                    </svg>
                                </div>
                                مدیریت وظایف
                            </a>
                            <a class="dropdown-item" href="#!">
                                <div class="dropdown-item-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-plus-circle text-gray-500">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="8" x2="12" y2="16"></line>
                                        <line x1="8" y1="12" x2="16" y2="12"></line>
                                    </svg>
                                </div>
                                افزودن وظیفه جدید
                            </a>
                            <a class="dropdown-item" href="#!">
                                <div class="dropdown-item-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-minus-circle text-gray-500">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="8" y1="12" x2="16" y2="12"></line>
                                    </svg>
                                </div>
                                حذف وظایف
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h4 class="small">
                        بروزرسانی سرور
                        <span class="float-end fw-bold">20%</span>
                    </h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small">
                        هماهنگ سازی سفارشات و فاکتورها
                        <span class="float-end fw-bold">40%</span>
                    </h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small">
                        دیتابیس کاربران
                        <span class="float-end fw-bold">60%</span>
                    </h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small">
                        مشخصات پرداخت
                        <span class="float-end fw-bold">80%</span>
                    </h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small">
                        ایحاد حساب
                        <span class="float-end fw-bold">به اتمام رسید!</span>
                    </h4>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="card-footer position-relative">
                    <div class="d-flex align-items-center justify-content-between small text-body">
                        <a class="stretched-link text-body" href="#!">برو به مرکز وظایف</a>
                        <i class="bx bx-chevrons-left"></i>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')

@endsection
