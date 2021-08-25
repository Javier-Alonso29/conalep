@extends('layouts.admin')

@section('titulo','Documentos')

@section('contenido')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Mis Documentos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Documentos</li>
                </ol>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

@if(session('success'))
<div id="toastsContainerTopRight" class="toasts-top-right fixed">
    <div class="toast bg-navy fade show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="6000">
        <div class="toast-header">
            <strong class="mr-auto">¡Exito! ... </strong>
            <small>Documento</small>
            <button data-dismiss="toast" type="button" class="ml-2 mb-1 close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="toast-body">{{session('success')}}</div>
    </div>
</div>
@endif

@if(session('error'))
<div id="toastsContainerTopRight" class="toasts-top-right fixed">
    <div class="toast bg-danger fade show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="6000">
        <div class="toast-header">
            <strong class="mr-auto">¡Error! ...</strong>
            <small>Documento</small>
            <button data-dismiss="toast" type="button" class="ml-2 mb-1 close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="toast-body">{{session('error')}}</div>
    </div>
</div>
@endif

<section class="container">
    <div class="row">
        <div class="col-12">
            <div class="card ">
                <div class="card-header bg-dark">
                    <h3 class="card-title">Documentos</h3>
                    <div class="card-tools">
                        <a href="#" data-toggle="modal" data-target="#crear" class="btn btn-success btn-tool">Nuevo documento</a>

                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>

                    </div>
                </div>
                <div class="card-body p-0" style="display: block;">
                    <table class="table table-striped projects table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Tipo de Documento</th>
                                <th>Proceso</th>
                                <th>Ciclo</th>
                                <th>Operaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($documentos_array as $documento)
                                <tr>
                                    <td>{{ $loop->iteration  }}</td>
                                    <td>{{ $documento->nombre  }}</td>
                                    <td>{{ $documento->tipodocumento->codigo  }}</td>
                                    <td>
                                        <a class="btn btn-success btn-circle btn-sm" href="{{route('misCarpetas.bySubproceso',$documento->procesopersonal->id_proceso)}}" role="button">
                                            <i class="fas fa-angle-double-left"> {{ $documento->procesopersonal->codigo }}</i>
                                        </a>
                                    </td>
                                    <td>{{ $documento->ciclo->nombre  }}</td>
                                    <td>
                                        <a data-toggle="modal" data-target="#editar-documento" class="btn btn-info btn-circle btn-sm" data-datos="{{$documento}}" href="#">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a data-toggle="modal" data-target="#downloadFile" class="btn btn-primary btn-circle btn-sm" data-datos="{{$documento}}" href="#">
                                            <i class="fa fa-download"></i>
                                        </a>
                                        <a data-toggle="modal" data-target="#eliminar-documento" class="btn btn-danger btn-circle btn-sm" data-datos="{{$documento}}" href="#">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">Ningún documento registrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

    </div>
    <!-- Row -->
</section>

<a data-toggle="modal" data-target="#crear" class="btn btn-success back-to-top" role="button" href="#" >
    <i class="fas fa-plus fa-lg"></i>
</a>

@include('administrador.documentos.create')
@include('administrador.documentos.edit')
@include('administrador.documentos.delete')
@include('administrador.documentos.downloadFile')

@endsection

@section('scripts')s
<script type="text/javascript">
    $('#editar-documento').on('show.bs.modal', function(e) {
        var documento = $(e.relatedTarget).data().datos;
        //AJAX
        $.get('/api/documento/tipo_documento', function(data) {
            var tipo_de_doc = documento.tipodocumento.nombre;
            var html_select;
            for (var i = 0; i < data.length; i++)
                if (tipo_de_doc == data[i].nombre)
                    html_select += '<option value="' + data[i].id + '" selected>' + data[i].nombre + '</option>';
                else
                    html_select += '<option value="' + data[i].id + '">' + data[i].nombre + '</option>';
            $('#tipodocumento_select').html(html_select);
        });

        $.get('/api/documento/api_procesos_personal', function(data) {
            var procper = documento.procesopersonal.codigo;
            var html_select;
            for (var i = 0; i < data.length; i++)
                if (procper == data[i].codigo)
                    html_select += '<option value="' + data[i].id + '" selected>' + data[i].codigo + '</option>';
                else
                    html_select += '<option value="' + data[i].id + '">' + data[i].codigo + '</option>';
            $('#procesopersonal_select').html(html_select);
        });

        $('#documento_nombre').val(documento.nombre);
        $('#documento_id').val(documento.id);
    });

    $('#eliminar-documento').on('show.bs.modal', function(e) {
        var documento = $(e.relatedTarget).data().datos;
        console.log(documento);
        $('#id_documento').val(documento.id);
        $('#nombre_documento').text(documento.nombre);
    });

    $('#downloadFile').on('show.bs.modal', function(e) {
        var documento = $(e.relatedTarget).data().datos;
        console.log(documento);
        $('#downloadFile_id').val(documento.id);
        $('#downloadFile_name').text(documento.nombre);
    });
</script>

<script>
    $(document).ready(function() {
        $('.toast').toast('show')
    })
</script>

@stop