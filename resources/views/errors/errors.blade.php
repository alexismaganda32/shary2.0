<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>:: Booking Seadust - ERROR ::</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('/images/favicon_seadust.png') }}"/>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}" defer></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip({ trigger: "hover" });
            $('[data-toggle="popover"]').popover({ trigger: "hover" });
        });
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/essentials.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.css') }}">
    <style>
        html{
            height: 100%;
            overflow: hidden;
        }
        .authentication {
            background: #ecf0f5;
        }
        .sky-form header{
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
            background: transparent;
        }
        form.boxed{
            border-radius: 5px;
            background-color: #ffffff80 !important;
            border-style: inset!important;
            border-width: 7px!important;
            border-color: #263238!important; 
        }
        .sky-form .btn {
            margin: 0;
        }
        .logo {
            width: 300px;
            height: 162px;
        }
        h1 {
            font-size: 75px;
            font-weight: 700;
            margin-top: 0;
            margin-bottom: 10px;
            color: #151723;
            text-transform: uppercase;
        }
    </style>
</head>
<body class="authentication">

    <div class="padding-15">
        <div class="login-box">
            <div class="text-center margin-bottom-40 margin-top-40">
                <img src="{{ asset('images/logo_seadust_negro.png') }}" alt="seadustcancun" class="logo">
            </div>
            <form class="sky-form boxed pricing-table popular">
                @csrf
                <header class="text-center">
                    <h1>@yield('code')</h1>
                    <p class="bold margin-bottom-0">Booking Seadust</p>
                    <p class="size-15 margin-bottom-10">@yield('messageError')</p>
                    <small class="note bold size-20" data-toggle="popover" data-placement="bottom" title="@yield('error')">
                        <i class="fas fa-exclamation-circle"></i>
                    </small>
                </header>
                
                <fieldset>  
                    <section class="text-center">
                        <a class="btn btn-primary btn-lg btn-block margin-bottom-10" href="{{ url('/') }}"><i class="fas fa-home"></i> Inicio</a>
                        <small class="note bold">Póngase en contacto con el administrador si el problema persiste.</small>
                    </section>
                </fieldset>
            </form>
            <hr/>
        </div>
    </div>

</body>
</html>
