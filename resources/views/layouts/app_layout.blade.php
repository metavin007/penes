<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" sizes="16x16" href="https://amworkweb.com/wp-content/uploads/2019/07/FA-icon.png">
        <title>โปรแกรม บริษัท ยูนิเวิร์สโค้ดดิ้งแอนด์ดีไซน์ จำกัด (สำนักงานใหญ่) </title>
        <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
        <link href="{{ asset('css/colors/blue.css') }}" id="theme" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">
        <link href="{{ asset('plugins/datatables/media/css/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css">     
        <link href="{{ asset('sweetalert2/sweetalert2.css') }}" rel="stylesheet" type="text/css">
        <!--<link href="{{ asset('plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />-->
        <link href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css" />

        <!--css ของอัพโหลดรูป-->
        <link href="{{ asset('plugins/dropify/dist/css/dropify.min.css') }}" rel="stylesheet">
        <!--css เปิดดูรูปภาพ-->
        <link href="{{ asset('plugins/Magnific-Popup-master/dist/magnific-popup.css') }}" rel="stylesheet">

        @yield('css_bottom')
    </head>
    <body class="fix-header card-no-border">
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
        </div>
        <div id="main-wrapper">
            @include('layouts.app_header')
            @include('layouts.app_sidebar')
            <div class="page-wrapper">
                @yield('body')
                @include('layouts.app_footer')
            </div>
        </div>

        <script>
            var url_gb = `{{url('')}}`;
            var asset_gb = `{{asset('')}}`;
        </script>

        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap/js/popper.min.js')}}"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{ asset('js/jquery.slimscroll.js')}}"></script>
        <script src="{{ asset('js/waves.js')}}"></script>
        <script src="{{ asset('js/sidebarmenu.js')}}"></script>
        <script src="{{ asset('/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
        <script src="{{ asset('js/custom.min.js')}}"></script>
        <script src="{{ asset('plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>
        <!--css ของอัพโหลดรูป-->
        <script src="{{ asset('plugins/dropify/dist/js/dropify.js') }}"></script>
 
        <!--js ของ datatable-->
        <script src="{{ asset('plugins/datatables/datatables.js') }}"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
        <script src="{{ asset('js/script_custom.js') }}"></script>
        <script src="{{ asset('plugins/moment/moment.js') }}"></script>
        <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script><!--
        <script src="{{ asset('plugins/select2/dist/js/select2.full.min.js') }}"></script>-->
        <script src="{{ asset('sweetalert2/sweetalert2.all.js') }}"></script>    
        <script src="{{ asset('js/jquery.validate.js') }}"></script>
        <script src="{{ asset('js/button.js') }}"></script>
            <!--<script src="{{ asset('js/upload_img.js') }}"></script>-->
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        @yield('js_bottom')
    </body>
</html>
