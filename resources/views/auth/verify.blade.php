@extends('layouts.appLogin')

@section('content')

<div class="padding-15">
    <div class="login-box">
        <div class="text-center margin-bottom-30">
            <img src="{{ asset('images/logo.png') }}" alt="permissionsImg" class="logo">
        </div>
        <form action="{{ route('verification.resend') }}" method="POST" class="sky-form boxed pricing-table popular">
            @csrf

            <header>
                <p class="bold size-15 margin-bottom-20">Verificar Email</p>
                <p class="bold margin-bottom-0">Permissions</p>
                <p class="size-15 margin-bottom-0">Verifique su dirección de correo electrónico.</p>
            </header>

            <fieldset>
                <section>
                    <p>
                        Antes de poder continuar, por favor, confirma tu correo electrónico con el enlace que te hemos enviado.
                    </p>
                    <p>
                        Si no has recibido el email,
                    </p>
                </section>
                <section>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">haga clic aquí para solicitar otro</button>
                    <br>
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="size-15">Iniciar sesión!</a>
                    </div>
                </section>
            </fieldset>
        </form>
        <hr/>
        @if (session('resent'))
            <div class="alert alert-success  margin-bottom-0" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                Se ha enviado un nuevo enlace de verificación a su dirección de correo electrónico.
            </div>
        @endif
    </div>
</div>

@endsection
