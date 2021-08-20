@extends('layouts.admin')

@section('titulo','Ciclos escolares')

@section('contenido')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Ciclos escolares</h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ciclos escolares</li>
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
                    <h3 class="card-title">Ciclos escolares registrados</h3>

                    <div class="card-tools">
                        <div class="btn btn-tool">
                            <a href="#" data-toggle="modal" data-target="#crear" class="btn btn-success btn-block">Nuevo ciclo escolar</a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0" style="display: block;">
                    <table class="table table-striped projects table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre del ciclo escolar</th>
                                <th>Inicio</th>
                                <th>Conclusión</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ciclos as $ciclo)
                            <tr>
                                <td>{{ $loop->iteration  }}</td>
                                <td>{{ $ciclo->nombre }}</td>
                                <td>{{ $ciclo->inicio }}</td>
                                <td>{{ $ciclo->conclusion  }}</td>
                                <td>
                                    <a class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#eliminar" href="#" data-datos="{{$ciclo}}">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                    <button class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#editar" id="btn-edit-plantel" href="#" data-datos="{{$ciclo}}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">Ningún ciclo escolar registrado.</td>
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


@include('SUEstatal.ciclos.create')
@include('SUEstatal.ciclos.delete')
@include('SUEstatal.ciclos.edit')
@endsection

@section('scripts')
<script type="text/javascript">
    $('#eliminar').on('show.bs.modal', function(e) {
        var ciclo = $(e.relatedTarget).data().datos;
        $('#id').val(ciclo.id);
        $('#nombre').text(ciclo.nombre);
    });

    $('#editar').on('show.bs.modal', function(e) {
        var ciclo = $(e.relatedTarget).data().datos;

        $('#id').val(ciclo.id);
        $('#nombre').val(ciclo.nombre);
        $('#inicio').val(ciclo.inicio);
        $('#conclusion').val(ciclo.conclusion);
        
    });
</script>

@stop