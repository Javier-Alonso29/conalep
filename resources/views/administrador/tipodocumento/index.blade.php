@extends('layouts.admin')

@section('titulo','Tipos de Documentos')

@section('contenido')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tipos de documentos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tipos de documentos</li>
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
            <small>Tipo de documento</small>
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
            <small>Tipo de documento</small>
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
                    <h3 class="card-title">Tipo de documento</h3>
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
                                <th>Codigo</th>
                                <th>Operaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tipodocumento as $tipo)
                            <tr>
                                <td>{{ $loop->iteration  }}</td>
                                <td>{{ $tipo->nombre  }}</td>
                                <td>{{ $tipo->codigo  }}</td>
                                <td>
                                    <a class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#eliminar-tipodocumento" href="#" data-datos="{{$tipo}}">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                    <a class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#editar-tipodocumento" href="#" data-datos="{{$tipo}}">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#downloadFolder-tipodocumento" href="#" data-datos="{{$tipo}}">
                                        <i class="fa fa-download"></i>
                                    </a>

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">Ningún tipo de documento registrado.</td>
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
        @if ((Auth::user()->rol_id) == 3)
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-dark">Operaciones Generales</div>
                <div class="card-body">
                    <p class="card-text">Operaciones generales que puedes hacer a todos los tipos de documentos registrados</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="#" data-toggle="modal" data-target="#crear-tipodocumento" class="btn btn-success btn-block">Nuevo tipo de documento</a></li>
                </ul>
                <div class="card-footer text-center">Tipos de documentos</div>
            </div>
        </div>
        
        @endif
        <!-- Col -->
    </div>
    <!-- Row -->
</section>






@include('administrador.tipodocumento.create')
@include('administrador.tipodocumento.delete')
@include('administrador.tipodocumento.edit')
@include('administrador.tipodocumento.downloadFolder')
@endsection

@section('scripts')
<script type="text/javascript">
    $('#eliminar-tipodocumento').on('show.bs.modal', function(e) {
        var tipodocumento = $(e.relatedTarget).data().datos;
        console.log(tipodocumento);
        $('#eliminarId').val(tipodocumento.id);
        $('#nombre_tipodocumento').text(tipodocumento.codigo);
    });

    $('#editar-tipodocumento').on('show.bs.modal', function(e) {
        var tipodocumento = $(e.relatedTarget).data().datos;
        console.log(tipodocumento);
        $('#edit_tipodocumento').val(tipodocumento.nombre);
        $('#edit_codigo').val(tipodocumento.codigo);
        $('#edit_descripcion').val(tipodocumento.descripcion);
        $('#id_tipodocumento').val(tipodocumento.id);
    });


    $('#downloadFolder-tipodocumento').on('show.bs.modal', function(e) {
        var proceso = $(e.relatedTarget).data().datos;
        console.log(tipodocumento);
        $('#downloadFolder_id').val(tipodocumento.id);
        $('#codigo_tipodocumento').text(tipodocumento.codigo);
    });
</script>

<script>
    $(document).ready(function() {
        $('.toast').toast('show')
    })
</script>

@stop