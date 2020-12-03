@extends('layouts.app')
@section('content')


<div class="container">

    <div class="row align-items-center">

        <div class="col">
            <h1 style="color:#FFF">Sistema de gestión y administración de archivos</h1>
            <p style="color:#FFF">Sistema de gestión y administración de archivos para el Colegio Nacional de Educación Profesional Técnica (CONALEP).</p>
        </div>

        <div class="col">

            <div class="card w-75">

                <img src="{{ asset('imagenes/Conalep-logo.png') }}" alt="Injuventud" class="img-fluid img-thumbnail m-2" >

                <div class="card-body tarjeta_registro">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!--Nombre-->
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input placeholder="Nombre" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!--App_paterno-->
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input placeholder="Primer apellido" id="app_paterno" type="text" class="form-control @error('app_paterno') is-invalid @enderror" name="app_paterno" value="{{ old('app_paterno') }}" autocomplete="app_paterno" autofocus>
                                @error('app_paterno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!--App_materno-->
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input placeholder="Segundo apellido" id="app_materno" type="text" class="form-control @error('app_materno') is-invalid @enderror" name="app_materno" value="{{ old('app_materno') }}" autocomplete="app_materno" autofocus>
                                @error('app_materno')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!--correo-->
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input placeholder="Correo" id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!--contraseña-->
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="password" placeholder="Contraseña" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required >

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!--confirma contraseña-->
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input id="password-confirm" placeholder="Confirma contraseña" type="password" class="form-control" name="password_confirmation" required >
                            </div>
                        </div>


                        <!--btn registrate-->
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success btn-block">
                                Registrate
                                </button>
                            </div>
                        </div>

                    </form>

                    <hr>
                    <div class="text-center">
                        <a href="{{ route('login') }}">¿Ya tienes una cuenta? ¡Entrar!</a>
                    </div>
                </div>
                </div>
        </div>

    </div>
</div>
@endsection