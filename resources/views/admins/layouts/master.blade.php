<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
          content="Volgh –  Bootstrap 4 Responsive Application Admin panel Theme Ui Kit & Premium Dashboard Design Modern Flat HTML Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
          content="analytics dashboard, bootstrap 4 web app admin template, bootstrap admin panel, bootstrap admin template, bootstrap dashboard, bootstrap panel, Application dashboard design, dashboard design template, dashboard jquery clean html, dashboard template theme, dashboard responsive ui, html admin backend template ui kit, html flat dashboard template, it admin dashboard ui, premium modern html template">
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
    @include('admins.layouts.head')
</head>

<body class="app sidebar-mini">
<!-- GLOBAL-LOADER -->
<div id="global-loader">
    <img src="{{URL::asset('assets/images/loader.svg')}}" class="loader-img" alt="Loader">
</div>
<!-- /GLOBAL-LOADER -->
<!-- PAGE -->
<div class="page">
    <div class="page-main">
        @include('admins.layouts.app-sidebar')
        @include('admins.layouts.mobile-header')
        <div class="app-content">
            <div class="side-app">
                <div class="page-header">
                    @yield('page-header')
                    @include('admins.layouts.notification')
                </div>
                @yield('content')
                @include('admins.layouts.sidebar')
                @include('admins.layouts.footer')
            </div>
        </div>
@include('admins.layouts.footer-scripts')
@include('sweetalert::alert')
</body>
</html>
