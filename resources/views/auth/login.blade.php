@extends('layouts.app')
@section('title', 'Iniciar sesión')
@section('content')

<div class="container">
  <!-- Outer Row -->
  <div class="row justify-content-center">

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row ">

            <div class="col">
              <div class="p-5">
                <img src="{{ asset('imagenes/Conalep-logo.png') }}" alt="Injuventud" class="img-fluid img-thumbnail m-2" style="width: 19rem;">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Inicia sesión</h1>
                </div>

                <!-- Envio de datos -->
                <form class="user" method="POST" action="{{ route('login') }}">
                  @csrf
                  <div class="form-group">
                    <input id="email" type="email" placeholder="Correo" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"  autofocus >
                    @foreach ($errors->all() as $error)
                    <div role="alert" class="invalid-feedback">Usuario o contraseña incorrecto</div>
                    @endforeach
                  </div>
                  <div class="form-group">
                    <input id="password" type="password" placeholder="Contraseña" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
                    <input id="name" type="hidden" name="name" value="{{ old('email') }}">

                    @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <button class="btn btn-success btn-user btn-block ">Entrar</button>

                  </div>
                  <hr>

                </form>
                <!-- Cierre del from -->

              <div class="text-center">
                <div class="text-center">
                @if (Route::has('password.request'))
                <a  href="{{ route('password.request') }}">
                  {{ __('¿Olvidaste tu contraseña?') }}
                </a>
                  @endif
                </div>
                </div>
                <div class="text-center">
                  <a  href="{{ Route('register') }}">!Registrate!</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

  </div>

</div>

@endsection
