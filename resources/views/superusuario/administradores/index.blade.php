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
                        <a href="#" data-toggle="modal" data-target="#crear" class="btn btn-success btn-block">Nuevo administrador</a>
                    </div>
                </div>
                </div>
                <div class="card-body p-0" style="display: block;">
                <table class="table table-striped projects table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Plantel</th>
                            <th>Fecha registro</th>
                            <th>Procesos</th>
                            <th>Operaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($usuario as $admin)
                        <tr>
                            <td>{{  $loop->iteration  }}</td>
                            <td>{{  $admin->name  }} {{  $admin->apellido_paterno  }} {{  $admin->apellido_materno  }}</td>
                            <td>{{  $admin->email  }}</td>
                            <td>{{  $admin->plantel->nombre_plantel }}</td>
                            <td>{{ $admin->created_at }}</td>
                            <td>
                                <a href="{{route('usuario.asigna.permisos', $admin->id)}}" class="btn btn-success btn-circle btn-sm">
                                    Gestionar
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#eliminar"  href="#" data-datos="{{$admin}}">
                                    <i class="fa fa-trash" ></i>
                                </a>
                                
                                <a class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#editar" href="#" data-datos="{{$admin}}" >
                                    <i class="fa fa-edit" ></i>
                                </a>

                                <a class="btn btn-warning btn-circle btn-sm" data-toggle="modal" data-target="#cambiar-pass" href="#" data-datos="{{$admin}}" >
                                    <i class="fa fa-key" ></i>
                                </a>

                            </td>
                        </tr>
                        @empty
                        <tr>
							<td colspan="6">Ningún administrador registrado en este plantel.</td>
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
@include('superusuario.administradores.cambiar-pass')
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

        //AJAX
        $.get('/api/administradores/plantel', function(data){
            var plantel_administrador = usuario.id_plantel;
            console.log(plantel_administrador);
            
            var html_select;
            for (var i = 0; i < data.length; i++)
                if (plantel_administrador == data[i].id_plantel)
                    html_select += '<option value="' + data[i].id_plantel + '" selected>' + data[i].plantel.nombre_plantel + '</option>';
                else
                    html_select += '<option value="' + data[i].id_plantel + '">' + data[i].plantel.nombre_plantel + '</option>';
            $('#select-plantel').html(html_select);
        });

		$('#nombre_usuario_edit').val(usuario.name);
		$('#id_usuario').val(usuario.id);
		$('#user_name').val(usuario.name);
		$('#apellido_paterno').val(usuario.apellido_paterno);
		$('#apellido_materno').val(usuario.apellido_materno);
        $('#email').val(usuario.email);

	});

    $('#cambiar-pass').on('show.bs.modal', function(e) {
		var usuario = $(e.relatedTarget).data().datos;
		console.log(usuario);
        $('#nombre_usuario_cambio').val(usuario.name);
		$('#id_usuario_cambio').val(usuario.id);
		$('#pass_usuario_cambio').val(usuario.password);
	});

    

</script>

@stop




