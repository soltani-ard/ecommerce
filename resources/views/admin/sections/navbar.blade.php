<nav
    class="is-rtl topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white"
    id="snavAccordion">
    <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle">
        <i class="bx bx-menu bx-sm"></i>
    </button>
    <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="index.html">داشبورد مدیریتی</a>
    <form class="form-inline me-auto d-none d-lg-block me-3">
        <div class="input-group input-group-joined input-group-solid">
            <input class="form-control pe-0" type="search" placeholder="جستجو ..." aria-label="جستجو">
            <div class="input-group-text"><i class="bx bx-search bx-sm"></i></div>
        </div>
    </form>

    <!-- Navbar Items-->
    <ul class="navbar-nav align-items-center ms-auto">

        <!-- Documentation Dropdown-->
        <li class="nav-item dropdown no-caret d-none d-md-block me-3">
            <a class="nav-link dropdown-toggle" id="navbarDropdownDocs" href="javascript:void(0);" role="button"
               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="fw-500">راهنما</div>
                <i class="bx bx-chevron-down bx-sm"></i>
            </a>
            <div
                class="dropdown-menu dropdown-menu-w15 dropdown-menu-start py-0 ms-sm-n15 ms-lg-0 o-hidden animated--fade-in-up"
                aria-labelledby="navbarDropdownDocs">
                <a class="dropdown-item py-3" href="#" target="_blank">

                    <div>
                        <div class="small text-gray-500">راهنما</div>
                        نحوه استفاده از قالب
                    </div>
                </a>
                <div class="dropdown-divider m-0"></div>
                <a class="dropdown-item py-3" href="#" target="_blank">

                    <div>
                        <div class="small text-gray-500">کامپوننت ها</div>
                        لیست تمام کامپوننت ها
                    </div>
                </a>
                <div class="dropdown-divider m-0"></div>
                <a class="dropdown-item py-3" href="#" target="_blank">

                    <div>
                        <div class="small text-gray-500">لیست تغییرات</div>
                        بروزرسانی های صورت گرفته
                    </div>
                </a>
            </div>
        </li>


        <!-- Navbar Search Dropdown-->
        <!-- * * Note: * * Visible only below the lg breakpoint-->
        <li class="nav-item dropdown no-caret me-3 d-lg-none">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="searchDropdown" href="#" role="button"
               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bx bx-search bx-sm"></i>
            </a>
            <!-- Dropdown - Search-->
            <div class="dropdown-menu dropdown-menu-end p-3 shadow animated--fade-in-up"
                 aria-labelledby="searchDropdown">
                <form class="form-inline me-auto w-100">
                    <div class="input-group input-group-joined input-group-solid">
                        <input class="form-control pe-0" type="text" placeholder="جستجو ..." aria-label="Search"
                               aria-describedby="basic-addon2">
                        <div class="input-group-text"><i class="bx bx-search"></i></div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Alerts Dropdown-->
        <li class="nav-item dropdown no-caret d-none d-sm-block me-3 bdr-notify">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownAlerts"
               href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false">
                <i class="bx bx-bell bx-sm"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up"
                 aria-labelledby="navbarDropdownAlerts">
                <h6 class="dropdown-header bdr-notify-header">
                    <i class="bx bx-bell me-2"></i>
                    اعلان‌ها
                </h6>
                <div class="dropdown-div">

                    <!-- اعلان 1-->
                    <a class="dropdown-item bdr-notify-item" href="#">
                        <div class="bdr-notify-item-icon bg-warning"><i class="bx bx-wallet"></i></div>
                        <div class="bdr-notify-item-content">
                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم در صنعت چاپ است.</p>
                            <small class="text-muted">1 ساعت قبل</small>
                        </div>
                    </a>
                    <!-- اعلان 2-->
                    <a class="dropdown-item bdr-notify-item" href="#">
                        <div class="bdr-notify-item-icon bg-info"><i class="bx bx-wallet"></i></div>
                        <div class="bdr-notify-item-content">
                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم در صنعت چاپ است.</p>
                            <small class="text-muted">1 ساعت قبل</small>
                        </div>
                    </a>
                    <!-- اعلان 3-->
                    <a class="dropdown-item bdr-notify-item" href="#">
                        <div class="bdr-notify-item-icon bg-success"><i class="bx bx-wallet"></i></div>
                        <div class="bdr-notify-item-content">
                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم در صنعت چاپ است.</p>
                            <small class="text-muted">1 ساعت قبل</small>
                        </div>
                    </a>
                    <!-- اعلان 4-->
                    <a class="dropdown-item bdr-notify-item" href="#">
                        <div class="bdr-notify-item-icon bg-danger"><i class="bx bx-wallet"></i></div>
                        <div class="bdr-notify-item-content">
                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم در صنعت چاپ است.</p>
                            <small class="text-muted">1 ساعت قبل</small>
                        </div>
                    </a>

                </div>
                <a class="dropdown-item bdr-notify-footer" href="#">مشاهده همه اعلان ها</a>
            </div>
        </li>

        <!-- Messages Dropdown-->
        <li class="nav-item dropdown no-caret d-none d-sm-block me-3 bdr-notify">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownMessages"
               href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false">
                <i class="bx bx-envelope bx-sm"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up"
                 aria-labelledby="navbarDropdownMessages">
                <h6 class="dropdown-header bdr-notify-header">
                    <i class="bx bx-message me-2"></i>
                    پیام ها
                </h6>

                <div class="dropdown-div">

                    <!-- پیام 1-->
                    <a class="dropdown-item bdr-notify-item" href="#">
                        <img class="bdr-notify-item-img"
                             src="{{asset('assets/admin/img/illustrations/profiles/profile-1.png')}}">
                        <div class="bdr-notify-item-content">
                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم در صنعت چاپ است.</p>
                            <small class="text-muted">مرجان بابایی</small>
                        </div>
                    </a>

                    <!-- پیام 2-->
                    <a class="dropdown-item bdr-notify-item" href="#">
                        <img class="bdr-notify-item-img"
                             src="{{asset('assets/admin/img/illustrations/profiles/profile-2.png')}}">
                        <div class="bdr-notify-item-content">
                            <p>لورم ایپسوم متن ساختگی </p>
                            <small class="text-muted">سهیلا طاهری</small>
                        </div>
                    </a>

                    <!-- پیام 3-->
                    <a class="dropdown-item bdr-notify-item" href="#">
                        <img class="bdr-notify-item-img"
                             src="{{asset('assets/admin/img/illustrations/profiles/profile-3.png')}}">
                        <div class="bdr-notify-item-content">
                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم در صنعت چاپ است.</p>
                            <small class="text-muted">عسل شمس</small>
                        </div>
                    </a>

                    <!-- پیام 4-->
                    <a class="dropdown-item bdr-notify-item" href="#">
                        <img class="bdr-notify-item-img"
                             src="{{asset('assets/admin/img/illustrations/profiles/profile-4.png')}}">
                        <div class="bdr-notify-item-content">
                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم در صنعت چاپ است.</p>
                            <small class="text-muted">مجید احمدی</small>
                        </div>
                    </a>
                </div>


                <!-- Footer Link-->
                <a class="dropdown-item bdr-notify-footer" href="#">مشاهده همه پیام ها</a>
            </div>
        </li>
        <!-- User Dropdown-->
        <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage"
               href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false"><img class="img-fluid" src="{{asset('assets/admin/img/illustrations/profiles/profile-1.png')}}"></a>
            <div class="dropdown-menu dropdown-menu-w15 dropdown-menu-end border-0 shadow animated--fade-in-up"
                 aria-labelledby="navbarDropdownUserImage">
                <h6 class="dropdown-header d-flex align-items-center">
                    <img class="dropdown-user-img"
                         src="{{asset('assets/admin/img/illustrations/profiles/profile-1.png')}}">
                    <div class="dropdown-user-details">
                        <div class="dropdown-user-details-name">مرجان بابایی</div>
                        <div class="dropdown-user-details-email">مدیر سیستم</div>
                    </div>
                </h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                    <div class="dropdown-item-icon"><i class="bx bx-user"></i></div>
                    حساب کاربری
                </a>
                <a class="dropdown-item" href="#">
                    <div class="dropdown-item-icon"><i class="bx bx-lock"></i></div>
                    تغییر کلمه عبور
                </a>
                <a class="dropdown-item" href="#">
                    <div class="dropdown-item-icon"><i class="bx bxs-file-txt"></i></div>
                    مشاهده لاگ سیستم
                </a>
                <a class="dropdown-item" href="#">
                    <div class="dropdown-item-icon"><i class="bx bx-log-out"></i></div>
                    خروج
                </a>
            </div>
        </li>

    </ul>
</nav>
