@extends('layouts.appLogin')

@section('content')

<div class="padding-15">
    <div class="login-box">
        <div class="text-center margin-bottom-30">
            <img src="{{ asset('images/logo.png') }}" alt="permissionsImg" class="logo">
        </div>
        <form action="{{ route('password.update') }}" method="POST" class="sky-form boxed pricing-table popular">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <header>
                <p class="bold size-15 margin-bottom-20">CAMBIAR CONTRASEÑA</p>
                <p class="bold margin-bottom-0">Permmissions</p>
                <p class="size-15 margin-bottom-0">Ingrese su nueva contraseña.</p>
            </header>

            <fieldset>
                <section>
                    <label class="label">E-mail</label>
                    <label class="input">
                        <i class="icon-append fa fa-envelope"></i>
                        <input type="email" name="email" value="{{ $email ?? old('email') }}">
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
                </section>
                <section>
                    <label class="label">Confirmar contraseña</label>
                    <label class="input">
                        <i class="icon-append fa fa-lock"></i>
                        <input type="password" name="password_confirmation">
                        <b class="tooltip tooltip-top-right">confirmar contraseña</b>
                    </label>
                </section>
                <section>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Restablecer contraseña</button>
                    <br>
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="size-15">Iniciar sesión!</a>
                    </div>
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

@endsection
