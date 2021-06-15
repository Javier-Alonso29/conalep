@extends('layouts.admin')

@section('titulo','Inicio')

@section('contenido')
<!-- Vista principal del superusuairo -->
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
              <span class="info-box-number">{{$procesos_cantidad}}</span>
            </div>

          </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">

            <a class="info-box-icon bg-danger elevation-1" href="{{ route('subprocesos.index') }}">
              <i class="fas fa-cogs"></i>
            </a>
            <div class="info-box-content">
              <span class="info-box-text">Subprocesos</span>
              <span class="info-box-number">{{$subprocesos_cantidad}}</span>
            </div>
            
          </div>
        </div>

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <a class="info-box-icon bg-success elevation-1" href="{{ route('tipodocumento.index') }}">
              <i class="fas fa-folder"></i>
              </a>

              <div class="info-box-content">
                <span class="info-box-text">Tipos de documentos</span>
                <span class="info-box-number">{{$cantidad_tipos_documentos}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <a class="info-box-icon bg-primary elevation-1" href="{{ route('documentos.index') }}">
              <i class="fas fa-file"></i>
              </a>

              <div class="info-box-content">
                <span class="info-box-text">Documentos</span>
                <span class="info-box-number">{{$cantidad_documentos}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>

        @if ((Auth::user()->rol_id) == 1)
        <div class="row">
      

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              
              <a class="info-box-icon bg-warning elevation-1" href="{{ route('actividad.index') }}">
                <i class="fas fa-file-invoice"></i>
              </a>
              <div class="info-box-content">
                <span class="info-box-text">Historial de actividad</span>
              </div>
  
            </div>
          </div>

          @if ((Auth::user()->rol_id) == 3)
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              
              <a class="info-box-icon bg-warning elevation-1" href="{{ route('sesion.index') }}">
                <i class="fas fa-mouse-pointer"></i>
              </a>
              <div class="info-box-content">
                <span class="info-box-text">Accesos al sistema</span>
              </div>
  
            </div>
          </div>
          @endif

        </div>
        @endif

        

          <div class="col-12">
            <!-- Administradores -->
            <div class="card direct-chat direct-chat-success collapsed-card">
              <div class="card-header bg-dark">
                <h3 class="card-title">Administradores </h3>

                <div class="card-tools">

                  <div class="btn btn-tool">
                      <input type="search" class="form-control" type="search" placeholder="Buscar" >
                  </div>

                  <span title="3 New Messages" class="badge bg-primary">{{$cantidad_admins}}</span>

                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-plus"></i>
                  </button>

                  @if ((Auth::user()->rol_id) == 3)
                  <a class="btn btn-tool" href="{{ route('administradores.index') }}">
                    <i class="fas fa-angle-double-right"></i>
                  </a>
                  @endif

                 
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0" >
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Nombre</th>
                          <th>Correo</th>
                          <th>Plantel</th>
                          <th>Fecha registro</th>
                        </tr>
                      </thead>
                      <tbody>
                      @forelse ($admin as $usuario)
                        <tr>
                          <td>{{$usuario->id}}</td>
                          <td>{{$usuario->name}}</td>
                          <td>{{$usuario->email}}</td>
                          <td>plantel A</td>
                          <td>{{$usuario->created_at}}</td>
                      @empty
                        <tr>
                          <td colspan="5">Ningún usuario registrado</td>
                        </tr>
                      @endforelse
                      </tbody>
                    </table>
                  </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                CONALEP
              </div>
              <!-- /.card-footer-->
            </div>
            <!--/.direct-chat -->
          </div>
          </div>
</div>
@endsection