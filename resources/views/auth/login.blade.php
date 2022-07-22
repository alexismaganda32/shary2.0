@extends('layouts.appLogin')

@section('content')

<div class="padding-15">
    <div class="login-box">
        <div class="text-center margin-bottom-30">
            <img src="{{ asset('images/logo.png') }}" alt="permissionsImg" class="logo">
        </div>
        <form action="{{ route('login') }}" method="POST" class="sky-form boxed pricing-table popular">
            @csrf
            <header>
                <p class="bold size-15 margin-bottom-20">LOGIN</p>
                <p class="bold margin-bottom-0">Permissions</p>
                <p class="size-15 margin-bottom-0">Inicia sesión para comenzar tu sesión</p>
            </header>

            <fieldset>
                <section>
                    <label class="label">E-mail</label>
                    <label class="input">
                        <i class="icon-append fa fa-envelope"></i>
                        <input type="email" name="email" value="{{ old('email') }}">
                        <span class="tooltip tooltip-top-right">Correo electrónico</span>
                    </label>
                </section>

                <section>
                    <label class="label">Contraseña</label>
                    <label class="input">
                        <i class="icon-append fa fa-lock"></i>
                        <input type="password" name="password">
                        <b class="tooltip tooltip-top-right">Contraseña</b>
                    </label>
                    <label class="checkbox">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}><i></i>Recordarme
                    </label>
                </section>
                <!-- <div class="g-recaptcha" data-sitekey="your_site_key"></div>
                <br/> -->
                <div class="form-group mt-3">
                {!! NoCaptcha::renderJs('es', false, 'recaptchaCallback') !!}
                {!! NoCaptcha::display() !!}
                </div>
                <section>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Iniciar sesión</button>
                    <br>
                    @if (Route::has('password.request'))
                        <div class="text-center">
                            <a href="{{ route('password.request') }}" class="size-15">¿Se te olvidó tu contraseña?</a>
                        </div>
                    @endif
                </section>
            </fieldset>
        </form>
        <hr/>
        @if ($errors->any())
            <div class="alert alert-danger margin-bottom-0">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                @foreach ($errors->all() as $error)
                    <strong>Error!</strong> {{ $error }}
                    @break
                @endforeach
            </div>
        @endif
    </div>
</div>

<script> 
    var onloadCallback = function() {
        alert ("grecaptcha is ready");
    };
</script>

@endsection
