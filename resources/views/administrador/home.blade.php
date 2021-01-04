@extends('layouts.admin')

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
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              
              
              <a class="info-box-icon bg-info elevation-1" href="{{ route('procesos.index') }}">
                <i class="fas fa-cog"></i>
              </a>

              <div class="info-box-content">
                <span class="info-box-text">Procesos</span>
                <span class="info-box-number">
                  10
                  <small>%</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <a class="info-box-icon bg-danger elevation-1">
                <i class="fas fa-cogs"></i>
              </a>

              <div class="info-box-content">
                <span class="info-box-text">Sub procesos</span>
                <span class="info-box-number">41,410</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <a class="info-box-icon bg-success elevation-1">
              <i class="fas fa-folder-open"></i>
              </a>

              <div class="info-box-content">
                <span class="info-box-text">Tipos de documentos</span>
                <span class="info-box-number">760</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <a class="info-box-icon bg-primary elevation-1">
              <i class="fas fa-file"></i>
              </a>

              <div class="info-box-content">
                <span class="info-box-text">Documentos</span>
                <span class="info-box-number">2,000</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
</div>
@endsection