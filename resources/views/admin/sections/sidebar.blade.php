<div id="layoutSidenav_nav">
    <nav class="snav shadow-right snav-light">
        <div class="snav-menu">
            <div class="nav accordion" id="accordionSidenav">

                <div class="snav-menu-heading">داشبورد</div>

                <!-- پیشخوان -->
                <a class="nav-link pt-0" href="{{route('dashboard')}}">
                    <div class="nav-link-icon"><i class="bx bx-home"></i></div>
                    خانه
                </a>

                <div class="snav-menu-heading">مدیریت محصولات</div>
                <!-- برندها -->
                <a class="nav-link collapsed pt-0" href="javascript:void(0);" data-bs-toggle="collapse"
                   data-bs-target="#collapseBrands" aria-expanded="false" aria-controls="collapseBrands">
                    <div class="nav-link-icon"><i class='bx bx-registered'></i></div>
                    برندها
                    <div class="snav-collapse-arrow"><i class="bx bx-chevron-down"></i></div>
                </a>
                <div class="collapse" id="collapseBrands" data-bs-parent="#accordionSidenav">
                    <nav class="snav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                        <!-- عملیات برند -->
                        <a class="nav-link" href="{{route('admin.brands.create')}}">ایجاد برند جدید</a>
                        <a class="nav-link" href="{{route('admin.brands.index')}}">نمایش همه برندها</a>
                    </nav>
                </div>

                <!-- ویژگی‌ها -->
                <a class="nav-link collapsed pt-0" href="javascript:void(0);" data-bs-toggle="collapse"
                   data-bs-target="#collapseAttributes" aria-expanded="false" aria-controls="collapseAttributes">
                    <div class="nav-link-icon"><i class='bx bx-git-pull-request'></i></div>
                    ویژگی ها
                    <div class="snav-collapse-arrow"><i class="bx bx-chevron-down"></i></div>
                </a>
                <div class="collapse" id="collapseAttributes" data-bs-parent="#accordionSidenav">
                    <nav class="snav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                        <!-- عملیات ویژگی -->
                        <a class="nav-link" href="{{route('admin.attributes.create')}}">ایجاد ویژگی جدید</a>
                        <a class="nav-link" href="{{route('admin.attributes.index')}}">نمایش همه ویژگی ها</a>
                    </nav>
                </div>

                <!-- دسته‌بندی‌ها -->
                <a class="nav-link collapsed pt-0" href="javascript:void(0);" data-bs-toggle="collapse"
                   data-bs-target="#collapseCategories" aria-expanded="false" aria-controls="collapseCategories">
                    <div class="nav-link-icon"><i class='bx bx-category'></i></div>
                    دسته‌بندی‌ها
                    <div class="snav-collapse-arrow"><i class="bx bx-chevron-down"></i></div>
                </a>
                <div class="collapse" id="collapseCategories" data-bs-parent="#accordionSidenav">
                    <nav class="snav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                        <!-- عملیات دسته‌بندی -->
                        <a class="nav-link" href="{{route('admin.categories.create')}}">ایجاد دسته‌بندی جدید</a>
                        <a class="nav-link" href="{{route('admin.categories.index')}}">نمایش همه دسته‌بندی‌ها</a>
                    </nav>
                </div>

                <!-- تگ‌ها -->
                <a class="nav-link collapsed pt-0" href="javascript:void(0);" data-bs-toggle="collapse"
                   data-bs-target="#collapseTags" aria-expanded="false" aria-controls="collapseTags">
                    <div class="nav-link-icon"><i class='bx bx-purchase-tag'></i></div>
                    برچسب‌ها (تگ‌ها)
                    <div class="snav-collapse-arrow"><i class="bx bx-chevron-down"></i></div>
                </a>
                <div class="collapse" id="collapseTags" data-bs-parent="#accordionSidenav">
                    <nav class="snav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                        <!-- عملیات تگ -->
                        <a class="nav-link" href="{{route('admin.tags.create')}}">ایجاد برچسب جدید</a>
                        <a class="nav-link" href="{{route('admin.tags.index')}}">نمایش همه برچسب‌ها</a>
                    </nav>
                </div>

                <!-- محصولات -->
                <a class="nav-link collapsed pt-0" href="javascript:void(0);" data-bs-toggle="collapse"
                   data-bs-target="#collapseProducts" aria-expanded="false" aria-controls="collapseProducts">
                    <div class="nav-link-icon"><i class='bx bx-store'></i></div>
                    محصولات
                    <div class="snav-collapse-arrow"><i class="bx bx-chevron-down"></i></div>
                </a>
                <div class="collapse" id="collapseProducts" data-bs-parent="#accordionSidenav">
                    <nav class="snav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                        <!-- عملیات محصولات -->
                        <a class="nav-link" href="{{route('admin.products.create')}}">ایجاد محصول جدید</a>
                        <a class="nav-link" href="{{route('admin.products.index')}}">نمایش همه محصولات</a>
                    </nav>
                </div>

                <!-- بنرها -->
                <div class="snav-menu-heading">مدیریت بنرها</div>
                <!-- بنرها -->
                <a class="nav-link collapsed pt-0" href="javascript:void(0);" data-bs-toggle="collapse"
                   data-bs-target="#collapseBanners" aria-expanded="false" aria-controls="collapseBanners">
                    <div class="nav-link-icon"><i class='bx bx-registered'></i></div>
                    بنرها
                    <div class="snav-collapse-arrow"><i class="bx bx-chevron-down"></i></div>
                </a>
                <div class="collapse" id="collapseBanners" data-bs-parent="#accordionSidenav">
                    <nav class="snav-menu-nested nav accordion" id="accordionSidenavPagesMenu">
                        <!-- عملیات بنرها -->
                        <a class="nav-link" href="{{route('admin.banners.create')}}">ایجاد بنر جدید</a>
                        <a class="nav-link" href="{{route('admin.banners.index')}}">نمایش همه بنرها</a>
                    </nav>
                </div>


            </div>
        </div>
    </nav>
</div>
