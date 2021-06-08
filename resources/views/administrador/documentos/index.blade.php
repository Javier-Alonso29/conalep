@extends('layouts.admin')

@section('titulo','Documentos')

@section('contenido')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Documentos</h1>
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
        <div class="col-md-8">
            <div class="card ">
                <div class="card-header bg-dark">
                    <h3 class="card-title">Documentos</h3>
                    <div class="card-tools">
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
                                <th>@sortablelink('id_tipodocumento', 'Tipo de Documento')</th>
                                <th>@sortablelink('id_subproceso', 'Subproceso')</th>
                                <th>Operaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($documentos as $docu)
                            <tr>
                                <td>{{ $loop->iteration  }}</td>
                                <td>{{ $docu->nombre  }}</td>
                                <td>{{ $docu->tipodocumento->codigo  }}</td>
                                <td>{{ $docu->subproceso->codigo  }}</td>
                                <td>
                                    <a class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#eliminar-documento" href="#" data-datos="{{$docu}}">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                    <a class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#editar-documento" href="#" data-datos="{{$docu}}">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#download-documento" href="#" data-datos="{{$docu}}">
                                        <i class="fa fa-download"></i>
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
        <!-- Col -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-dark">Operaciones Generales</div>
                <div class="card-body">
                    <p class="card-text">Operaciones generales que puedes hacer a todos documentos registrados</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="" data-toggle="modal" data-target="#crear-documento" class="btn btn-success btn-block">Nuevo documento</a></li>
                </ul>
                <div class="card-footer text-center">Documentos</div>
            </div>
        </div>
        <!-- Col -->
    </div>
    <!-- Row -->
</section>






@include('administrador.documentos.create')
@include('administrador.documentos.delete')
@include('administrador.documentos.edit')
@include('administrador.documentos.download')
@endsection

@section('scripts')
<script type="text/javascript">
    $('#eliminar-documento').on('show.bs.modal', function(e) {
        var documento = $(e.relatedTarget).data().datos;
        console.log(documento);
        $('#id_documento').val(documento.id);
        $('#nombre_documento').text(documento.nombre);
    });

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

        $.get('/api/documento/subproceso', function(data) {
            var subproc = documento.subproceso.nombre;
            var html_select;
            for (var i = 0; i < data.length; i++)
                if (subproc == data[i].nombre)
                    html_select += '<option value="' + data[i].id + '" selected>' + data[i].nombre + '</option>';
                else
                    html_select += '<option value="' + data[i].id + '">' + data[i].nombre + '</option>';
            $('#subproceso_select').html(html_select);
        });

        $('#documento_nombre').val(documento.nombre);
        $('#documento_id').val(documento.id);
    });

    $('#download-documento').on('show.bs.modal', function(e) {
        var proceso = $(e.relatedTarget).data().datos;
        console.log(documento);
        $('#download_id').val(documento.id);
        $('#nombre_documento').text(documento.nombre);
    });
</script>

<script>
    $(document).ready(function() {
        $('.toast').toast('show')
    })
</script>

@stop