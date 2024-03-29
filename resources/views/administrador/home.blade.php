@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/home-documents.css')}}">
@endsection

@section('titulo','Inicio')

@section('contenido')
<!-- Vista principal del administrador -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">

      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Panel de control</h1>
      </div>

      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
          <li class="breadcrumb-item active"></li>
        </ol>
      </div>

    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>


<div class="container">
  <div class="row">

  <div class="clearfix hidden-md-up"></div>

    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <a class="info-box-icon bg-danger elevation-1" href="{{ route('subprocesos.index') }}">
        <i class="fas fa-folder"></i>
        </a>
        <div class="info-box-content">
          <span class="info-box-text">Subprocesos</span>
          <span class="info-box-number">{{$subprocesos_cantidad}}</span>
        </div> 
      </div>
    </div>
        

    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <a class="info-box-icon bg-primary elevation-1" href="{{ route('misCarpetas.index') }}">
          <i class="fas fa-folder"></i>
        </a>
        <div class="info-box-content">
            <span class="info-box-text">Procesos personales</span>
            <span class="info-box-number">{{$cantidad_procesos}}</span>
        </div>
      </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <a class="info-box-icon bg-success elevation-1"  href="{{ route('tipodocumento.index') }}">
          <i class="fas fa-folder"></i>
        </a>

        <div class="info-box-content">
          <span class="info-box-text">Tipos de documentos</span>
          <span class="info-box-number">{{$cantidad_tipos_documentos}}</span>
        </div>

      </div>
    </div>

    <div class="col-lg-12 col-12">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>Documentos</h3>

            <p>{{ $cantidad_documentos }}</p>{{-- Sujeto a cambios debido a que no está hecho completamente (gracias javis jsjsjsjs) --}}
        </div>
        <div class="icon">
        <i class="fas fa-file"></i>
        </div>
        <a href="{{ route('documentos.index') }}" class="small-box-footer">Ver mas <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>

  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-12">

    <!-- Tabla que almacena las tarjetas de los documentos -->
      <div class="card text-center">
        <div class="card-header bg-dark">
            <h3 class="card-title">Mis documentos</h3>
            <div class="card-tools">
              {{-- <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
              </div> --}}
            </div>
        </div>
        <!-- Dody de la tabla principal -->
        <div class="card-body">
          
          <div class="row row-cols-1 row-cols-md-3">

            @forelse($documentos_array as $documento)
              <div class="col mb-6">
                <div class="card text-center mb-3" style="width: 18rem;">
                  <!-- Se puede cambiar la imagen, file es de color verde y file2 es de color azul -->
                  <img href="{{ route('documentos.index') }}" src="{{ asset('imagenes/file.png') }}" class="card-img-top" alt="{{ $documento->nombre }}" >
                  <div class="card-body">
                  </div>
                    <a href="{{ route('documentos.index') }}" class="list-group-item list-group-item-action active" aria-current="true">
                      <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{$documento->nombre}}</h5>
                        <small>{{ $documento->created_at }}</small>
                      </div>
                      <hr>
                      <p class="mb-1">Proceso: {{ $documento->procesopersonal->codigo }}</p>
                      <p class="mb-1">Tipo de documento: {{ $documento->tipodocumento->nombre }}</p>
                        <small>{{Auth::user()->name}}</small>
                      </a>
                </div>
              </div>
            @empty 
              
            @endforelse

          </div>

        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#28a745" fill-opacity="1" d="M0,224L48,234.7C96,245,192,267,288,240C384,213,480,139,576,96C672,53,768,43,864,80C960,117,1056,203,1152,229.3C1248,256,1344,224,1392,208L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
       </div>


    </div>
  </div>
</div>

@endsection