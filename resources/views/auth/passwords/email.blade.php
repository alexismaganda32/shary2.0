@extends('layouts.appLogin')

@section('content')

<div class="padding-15">
    <div class="login-box">
        <div class="text-center margin-bottom-30">
            <img src="{{ asset('images/logo.png') }}" alt="permissionsImg" class="logo">
        </div>
        <form action="{{ route('password.email') }}" method="POST" class="sky-form boxed pricing-table popular">
            @csrf
            <header>
                <p class="bold size-15 margin-bottom-20">¿SE TE OLVIDÓ TU CONTRASEÑA?</p>
                <p class="bold margin-bottom-0">Permissions</p>
                <p class="size-15 margin-bottom-0">Ingrese su dirección de correo electrónico a continuación para restablecer su contraseña.</p>
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
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Restablecer mi contraseña</button>
                    <br>
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="size-15">Iniciar sesión!</a>
                    </div>
                </section>
            </fieldset>
        </form>
        <hr/>
        @if (session('status'))
            <div class="alert alert-success  margin-bottom-0" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                {{ session('status') }}
            </div>
        @endif
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
