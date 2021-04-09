@extends('layouts.admin')

@section('titulo','Permisos')

@section('contenido')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Asignacion de administradores a procesos</h1>
          </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Permisos</li>
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

            <div class="card">
                <div class="card-header bg-dark">
                    <h3 class="card-title">Permisos asignados</h3>

                    <div class="card-tools">
                        <div class="btn btn-tool">
                            <a href="" data-toggle="modal" data-target="#crear" class="btn btn-success btn-block">Asignar permisos</a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0" style="display: block;">
                <table class="table table-striped projects table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Administrador</th>
                            <th>procesos</th>
                            <th>Operaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($administradores as $administrador)
                        <tr>
                            <td>{{ $loop->iteration  }}</td>
                            <td>{{ $administrador->name }} {{ $administrador->apellido_paterno }} {{ $administrador->apellido_materno }}</td>
                            <td></td>
                        </tr>
                        @empty
                        <tr>
							<td colspan="5">Ningún permiso asociado.</td>
						</tr>
                        @endforelse
                    </tbody>
                    
                </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{$permisos->links()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- Col -->

    </div>
    <!-- Row -->
</section>

@include('superusuario.permisos.create')
@include('superusuario.permisos.eliminar')
@include('superusuario.permisos.edit')
@endsection

@section('scripts')
<script type="text/javascript">
    $('#eliminar').on('show.bs.modal', function(e) {
        var permiso = $(e.relatedTarget).data().datos;
        console.log(permiso);
        $('#id_user').val(permiso.id_user);
        $('#id_plantel').text(permiso.id_plantel);
        $('#id_proceso').text(permiso.id_proceso);

    });

    $('#editar').on('show.bs.modal', function(e) {

        var permiso = $(e.relatedTarget).data().datos;

        //PLANTEL
        $.get('/api/permisos/planteles', function(data) {

            var plantel_permiso = permiso.plantel;
            var html_select;

            for (var i = 0; i < data.length; i++)

                if (plantel_permiso.id == data[i].id)

                    html_select += '<option value="' + data[i].id + '" selected>' + data[i].clave_trabajo + '</option>';

                else
                    html_select += '<option value="' + data[i].id + '">' + data[i].clave_trabajo + '</option>';

            $('#select-plantel').html(html_select);
        });

        //PROCESO
        $.get('/api/permisos/procesos', function(data) {

            var proceso_permiso = permiso.proceso;
            var html_select;

            for (var i = 0; i < data.length; i++)

                if (proceso_permiso.id == data[i].id)

                    html_select += '<option value="' + data[i].id + '" selected>' + data[i].nombre + '</option>';

                else
                    html_select += '<option value="' + data[i].id + '">' + data[i].nombre + '</option>';

            $('#select-proceso').html(html_select);
        });

        //ADMINISTRADOR
        $.get('/api/permisos/usuarios', function(data) {

            var usuario_permiso = permiso.usuario;
            var html_select;

            for (var i = 0; i < data.length; i++)

                if (usuario_permiso.id == data[i].id)

                    html_select += '<option value="' + data[i].id + '" selected>' + data[i].name + ' ' + data[i].apellido_paterno + ' ' + data[i].apellido_materno + '</option>';

                else
                    html_select += '<option value="' + data[i].id + '">' + data[i].name + ' ' + data[i].apellido_paterno + ' ' + data[i].apellido_materno + '</option>';

            $('#select-usuario').html(html_select);
        });
        
        //DESCARGAR
        $.get('/api/permisos/descargar', function(data) {

            var descargar_permiso = permiso.descargar;
            var html_select;


            if (descargar_permiso == "0")

                html_select += '<option value="0" selected>No Permitido</option>' + '<option value="1" >Permitido</option>';

            else
                html_select += '<option value="1">Permitido</option>' + '<option value="0" >No Permitido</option>';

            $('#select-descargar').html(html_select);
        });

        //SUBIR
        $.get('/api/permisos/subir', function(data) {

            var subir_permiso = permiso.subir;
            var html_select;


            if (subir_permiso == "0")

                html_select += '<option value="0" selected>No Permitido</option>' + '<option value="1" >Permitido</option>';

            else
                html_select += '<option value="1">Permitido</option>' + '<option value="0" >No Permitido</option>';

            $('#select-subir').html(html_select);
        });


        //SUBIR
        $.get('/api/permisos/borrar', function(data) {

            var borrar_permiso = permiso.borrar;
            var html_select;


            if (borrar_permiso == "0")

                html_select += '<option value="0" selected>No Permitido</option>' + '<option value="1" >Permitido</option>';

            else
                html_select += '<option value="1">Permitido</option>' + '<option value="0" >No Permitido</option>';

            $('#select-borrar').html(html_select);
        });


        //DESCARGAR
        $.get('/api/permisos/leer', function(data) {

            var leer_permiso = permiso.descargar;
            var html_select;


            if (leer_permiso == "0")

                html_select += '<option value="0" selected>No Permitido</option>' + '<option value="1" >Permitido</option>';

            else
                html_select += '<option value="1">Permitido</option>' + '<option value="0" >No Permitido</option>';

            $('#select-leer').html(html_select);
        });

        $('#id_plantel').val(permiso.id_plantel);
        $('#id_proceso').val(permiso.id_proceso);
        $('#id_user').val(permiso.id_user);
        $('#leer').val(permiso.leer);
        $('#descargar').val(permiso.descargar);
        $('#subir').val(permiso.subir);
        $('#borrar').val(permiso.borrar);

    });
</script>

@stop