<!DOCTYPE html>
<html lang="fa" dir="rtl" class="overflow-unset">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    @include('admin.sections.css_links')
</head>
<body class="nav-fixed">

@include('admin.sections.navbar')
<div id="layoutSidenav">
    @include('admin.sections.sidebar')
    <div id="layoutSidenav_content">

        <main class="is-rtl">
            @yield('page-header')
            <!-- Main page content-->
            @yield('content')
        </main>
        @include('admin.sections.footer')
    </div>
</div>

@include('admin.sections.js_links')
</body>
</html>
