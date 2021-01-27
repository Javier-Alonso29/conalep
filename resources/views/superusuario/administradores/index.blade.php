@extends('layouts.admin')

@section('titulo','Administradores')

@section('contenido')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">

        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Administradores</h1>
          </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
              <li class="breadcrumb-item active" aria-current="page">Administradores</li>
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
        <div class="col-md-12">
        
            <div class="card ">
                <div class="card-header bg-dark">
                <h3 class="card-title">Administradores</h3>

                <div class="card-tools">
                    <div class="btn btn-tool">
                        <a href="" data-toggle="modal" data-target="#crear" class="btn btn-success btn-block">Nuevo administrador</a>
                    </div>
                </div>
                </div>
                <div class="card-body p-0" style="display: block;">
                <table class="table table-striped projects table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Fecha registro</th>
                            <th>E-Mail</th>
                            <th>Operaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($usuarios as $admin)
                        <tr>
                            <td>{{  $loop->iteration  }}</td>
                            <td>{{  $admin->name  }} {{  $admin->apellido_paterno  }} {{  $admin->apellido_materno  }}</td>
                            <td>{{ $admin->created_at }}</td>
                            <td>{{  $admin->email  }}</td>
                            <td>
                                <a class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#eliminar"  href="#" data-datos="{{$admin}}">
                                    <i class="fa fa-trash" ></i>
                                </a>
                                
                                <a class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#editar" href="#" data-datos="{{$admin}}" >
                                    <i class="fa fa-edit" ></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
							<td colspan="5">Ningún administrador registrado.</td>
						</tr>
                        @endforelse
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

@include('superusuario.administradores.create')
@include('superusuario.administradores.delete')
@include('superusuario.administradores.edit')
@endsection

@section('scripts')
<script type="text/javascript">

	$('#eliminar').on('show.bs.modal', function(e) {
		var usuario = $(e.relatedTarget).data().datos;
		console.log(usuario);
        $('#eliminarId').val(usuario.id);
		$('#nombre_usuario_delete').text(usuario.name);
	});

    $('#editar').on('show.bs.modal', function(e) {
		var usuario = $(e.relatedTarget).data().datos;
		console.log(usuario);
		$('#nombre_usuario_edit').val(usuario.name);
		$('#id_usuario').val(usuario.id);
		$('#user_name').val(usuario.name);
		$('#apellido_paterno').val(usuario.apellido_paterno);
		$('#apellido_materno').val(usuario.apellido_materno);
        $('#email').val(usuario.email);
	});

    

</script>

@stop




