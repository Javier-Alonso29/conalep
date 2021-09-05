@extends('layouts.admin')

@section('titulo','Permisos')

@section('contenido')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">

        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Asignacion de administrador a procesos</h1>
          </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
              <li class="breadcrumb-item"><a href="{{ route('administradores.index') }}">Administradores</a></li>
              <li class="breadcrumb-item active" aria-current="page">Permisos / {{$administrador->name}}</li>
            </ol>
        </div>

      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

@if(session('success'))
    <div class="col-sm-12">
        <div class="alert  alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="col-sm-12">
        <div class="alert  alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
    </div>
@endif

<section class="container">
    <div class="row">

        <div class="col-md-6">
        
            <div class="card">
                <div class="card-header bg-dark">
                <h3 class="card-title">Permisos disponibles para asignar</h3>

                <div class="card-tools">
                </div>
                </div>
                <div class="card-body p-0" style="display: block;">
                <table class="table table-striped projects table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Codigo</th>
                            <th>Operacion</th>
                            <th>Asignado</th>
                            
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($procesos_plantel as $proceso)
                            <tr>

                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $proceso->nombre }}</td>
                                <td>{{ $proceso->codigo }}</td>
                                <td>
                                    <a href="{{ route('usuario.asignar.proceso', array($administrador->id, $proceso->id)) }}" class="btn btn-success btn-sm">Activar</a>
                                </td>
                                <td>
                                    @foreach($procesos_administrador as $proceso_a)

                                        @if($proceso_a->id == $proceso->id )

                                            <i class="fas fa-check-circle fa-lg" style="color: #51cf66;"></i>

                                        @endif

                                    @endforeach
                                </td>
                            </tr>
                            
                        @endforeach
                        
                    </tbody>
                    
                </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- Col -->

        <div class="col-md-6">
        
            <div class="card">
                <div class="card-header bg-dark">
                <h3 class="card-title">Permisos en los que está asignado {{$administrador->name}}</h3>

                <div class="card-tools">
                </div>
                </div>
                <div class="card-body p-0" style="display: block;">
                <table class="table table-striped projects table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Codigo</th>
                            <th>Operaciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($procesos_administrador as $proceso)
                            <tr>

                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $proceso->nombre }}</td>
                                <td>{{ $proceso->codigo }}</td>
                                <td>
                                    <a href="{{ route('usuario.quitar.proceso', array($administrador->id, $proceso->id)) }}" class="btn btn-outline-danger btn-sm">Desactivar</a>
                                </td>
                            </tr>
                            
                        @endforeach
                        
                    </tbody>
                    
                </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- Col -->



    </div>
    <!-- Row -->
</section>

@endsection
