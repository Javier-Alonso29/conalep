@extends('layouts.admin')

@section('titulo','Mi Perfil')

@section('contenido')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">

        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Perfil de usuario</h1>
          </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
              <li class="breadcrumb-item active" aria-current="page">Perfil de usuario</li>
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
        <div class="col-12">
        
            <div class="card ">
                <div class="card-header bg-dark">
                <h3 class="card-title">Información de usuario</h3>

                <div class="card-tools">
                    <a href="" data-toggle="modal" data-target="#editar" class="btn btn-success btn-tool" data-datos="{{$user}}">Editar perfil</a>

                    <a href="" data-toggle="modal" data-target="#cambiar-pass" class="btn btn-warning btn-tool" data-datos="{{$user}}">Cambiar contraseña</a>
                </div>

                </div>
                <div class="card-body p-0" style="display: block;">
                <table class="table table-striped projects table-sm">
                    <thead>
                        <tr>
                            <th>Nombre completo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$user->name}} {{$user->apellido_paterno}} {{$user->apellido_materno}}</td>
                        </tr>
                    </tbody>

                    <thead>
                        <tr>
                            <th>Correo electrónico</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$user->email}}</td>
                        </tr>
                    </tbody>

                    <thead>
                        <tr>
                            <th>Rol</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (($user->rol_id) == 1)
                            <tr>
                                <td>Super Usuario</td>
                            </tr>
                        @endif

                        @if (($user->rol_id) == 2)
                            <tr>
                                <td>Administrador</td>
                            </tr>
                        @endif

                        @if (($user->rol_id) == 3)
                            <tr>
                                <td>Super Usuario Estatal</td>
                            </tr>
                        @endif

                    </tbody>

                    <thead>
                        <tr>
                            <th>Plantel</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>PENDIENTE</td>
                        </tr>
                    </tbody>

                    <thead>
                        <tr>
                            <th>Proceso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>PENDIENTE</td>
                        </tr>
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



@include('administrador.perfil.edit')
@include('administrador.perfil.cambiar-pass')
@endsection

@section('scripts')

<script type="text/javascript">

    $('#editar').on('show.bs.modal', function(e) {
		var user = $(e.relatedTarget).data().datos;
		console.log(user);
		$('#nombre_usuario_edit').val(user.name);
		$('#id_usuario').val(user.id);
		$('#user_name').val(user.name);
		$('#apellido_paterno').val(user.apellido_paterno);
		$('#apellido_materno').val(user.apellido_materno);
        $('#email').val(user.email);
        $('#password').val(user.password);
	});

    $('#cambiar-pass').on('show.bs.modal', function(e) {
		var user = $(e.relatedTarget).data().datos;
		$('#nombre_usuario_cambio').val(user.name);
		$('#id_usuario_cambio').val(user.id);
		$('#pass_usuario_cambio').val(user.password);
	});
    

</script>

@endsection
