<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" ng-app="seadust">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>:: Capacitacion ::</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('/images/favicon.png') }}"/>

    <!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

    <!-- Scripts recap -->
    <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->
    
    <!-- Scripts recap  end-->

    <!-- Scripts -->
    <script src="{{ asset('plugins/angularjs/angular.min.js') }}"></script>
    <script src="{{ asset('plugins/angularjs/angular-locale_es-mx.js') }}"></script>
    <script src="{{ asset('js/Controllers/Model.js') }}"></script>
    <script src="{{ asset('js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jais.js') }}"></script>
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip({ trigger: "hover" });
            $('[data-toggle="popover"]').popover({ trigger: "hover" });
            @if (Request::segment(1))
                let activeMenu =  $('li #{{ Request::segment(1) }}');
                if (activeMenu.length === 1) {
                    activeMenu.addClass('active-link');
                    let parents = activeMenu.parents('ul.collapse').addClass('in').parents('li').addClass('active-sub active');
                }
            @endif
            @if (session('message-error'))
                toastr.error('{{ session('message-error') }}', 'Alerta!');
            @endif
            @if ( $errors->any() )
                alert({{ $errors->first() }});
            @endif
            setTimeout(function(){
                $('.loadingView').slideUp('fast');
                $('.view').slideDown('slow');
            }, 1200);
        });
    </script>
    @yield('script')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/essentials.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jais.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
    <style type="text/css">
        #toast-container>div {
            padding: 30px 15px 30px 50px;
            width: 400px;
        }
        .toast-error {
            background-color: #c11c13;
        }
        .toast-title {
            font-size: 17px;
        }
    </style>
    @yield('style')
</head>
<body class="authentication">
    <div id="container" class="effect aside-float aside-bright mainnav-lg">

        <!--NAVBAR-->
        @include('layouts.appNavBar')
        <!--END NAVBAR-->

        <div class="boxed">

            <!--Content Container-->
            <div id="content-container">

                <div id="page-title">
                    <h1 class="page-header text-overflow">
                        <span class="heading_border"> @yield('title') </span>
                    </h1>
                </div>

                <div id="content" class="padding-15">
                    @yield('content')
                </div>

            </div>
            <!--End Content Container-->

            <!--MAIN NAVIGATION-->
            @include('layouts.appMenu')
            <!--END MAIN NAVIGATION-->

        </div>

        <!-- FOOTER -->
        <footer id="footer">
            <div class="show-fixed pull-right">
                You have <a href="#" class="text-bold text-main"><span class="label label-danger">3</span> pending action.</a>
            </div>
            <p class="pad-lft">&#0169; {{ date('Y') }} Proyecto Equipo 5 </p>
        </footer>
        <!-- END FOOTER -->

        <!-- SCROLL PAGE BUTTON -->
        <button class="scroll-top btn">
            <i class="pci-chevron chevron-up"></i>
        </button>

    </div>
    <!-- END OF CONTAINER -->

</body>
</html>
