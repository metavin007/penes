<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/colors/blue.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">
    </head>
    <body>
        <style>
            /*ใส่ฟ้อน*/
            body ,h1, h2, h3, h4, h5, h6,p{
                background: #fff;
                font-family: 'Sarabun' !important;
                margin: 0;
                overflow-x: hidden;
                color: #54667a;
                font-weight: 300; 
            }
        </style>
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
        </div>
        <section id="wrapper">
            <div class="login-register">        
                <div class="login-box card">
                    <div class="card-body">
                        <form class="form-horizontal form-material" id="loginform" method="POST" action="{{ route('login') }}">
                            <h3 class="box-title mb-3 text-center">เข้าสู่ระบบ</h3>
                            @csrf
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input class="form-control" type="email" name="email" required="" placeholder="อีเมล" value="peter@gmail.com"> 
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input class="form-control" type="password" name="password" required="" placeholder="รหัสผ่าน" value="123456789">
                                </div>
                            </div>
                            <div class="form-group text-center mt-3">
                                <div class="col-xs-12">
                                    <button class="btn btn-info btn-block text-uppercase waves-effect waves-light" type="submit">ล็อกอิน</button>
                                </div>
                            </div>
                            @error('email')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                            @error('password')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap/js/popper.min.js')}}"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{ asset('js/jquery.slimscroll.js')}}"></script>
        <script src="{{ asset('js/waves.js')}}"></script>
        <script src="{{ asset('js/sidebarmenu.js')}}"></script>
        <script src="{{ asset('/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
        <script src="{{ asset('js/custom.min.js')}}"></script>
        <script src="{{ asset('plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>
    </body>
</html>
