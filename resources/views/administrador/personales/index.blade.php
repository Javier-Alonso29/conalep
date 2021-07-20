@extends('layouts.admin')

@section('titulo','Procesos personales')

@section('contenido')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">

        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Procesos personales</h1>
        </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
              <li class="breadcrumb-item"><a href="{{ route('procesos.index') }}">Procesos</a></li>
              <li class="breadcrumb-item"><a href="{{ route('subprocesos.index') }}">Sub procesos</a></li>
              <li class="breadcrumb-item active" aria-current="page">Mis procesos</li>
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
                <h3 class="card-title">Todos tus procesos personales</h3>

                <div class="card-tools">
                    <a href="" data-toggle="modal" data-target="#crear" class="btn btn-success btn-tool">Nuevo proceso</a>

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
                            <th>Descripción</th>
                            <th>Tipos de documentos</th>
                            <th>Operaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($procesos_personales as $proceso_personal)
                            @foreach ($proceso_personal as $proceso)
                            <tr>
                                <td>{{  $loop->iteration  }}</td>
                                <td>{{  $proceso->nombre  }}</td>
                                <td>{{  $proceso->codigo  }}</td>
                                <td>
                                    <button type="button" class="btn btn-success btn-circle btn-sm" data-container="body" data-toggle="popover" data-placement="right" data-content="{{ $proceso->descripcion }}">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </td>
                                <td>
                                    <a class="btn btn-success btn-circle btn-sm" href="{{ route('documentos.byProcesoPersonal', $proceso->id) }}" role="button">
                                        <i class="fas fa-angle-double-right"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#editar" href="#" data-datos="{{$proceso}}" >
                                        <i class="fa fa-edit" ></i>
                                    </a>
                                    
                                    <a class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#downloadFolder" href="#" data-datos="{{$proceso}}" >
                                        <i class="fa fa-download"></i>
                                    </a>
                                    
                                    <a class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#eliminar_fitro_subproceso"  href="#" data-datos="{{$proceso}}">
                                        <i class="fa fa-trash" ></i>
                                    </a>
                                    
                                </td>
                            </tr>
                            @endforeach
                        @empty
                        <tr>
							<td colspan="5">Ningún subproceso registrado.</td>
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


<a href="#" data-toggle="modal" data-target="#crear" class="btn btn-success back-to-top" role="button">
    <i class="fas fa-plus fa-lg"></i>
</a>

@include('administrador.personales.create')
@include('administrador.personales.delete')
@include('administrador.personales.edit')

@endsection

@section('scripts')

<script src="{{ asset('js/appis.js') }}"></script>

<script type="text/javascript">

    $(function () {
        $('[data-toggle="popover"]').popover()
    })


	$('#eliminar').on('show.bs.modal', function(e) {
		let proceso = $(e.relatedTarget).data().datos;
        let proceso_origen = $(e.relatedTarget).data().proceso;
        let subproceso_origen = $(e.relatedTarget).data().subproceso;
        $('#eliminarId').val(proceso.id);
        $('#proceso_origen').val(proceso_origen.id);
        $('#subproceso_origen').val(subproceso_origen.id);
		$('#nombre_proceso').text(proceso.codigo);
	});

    $('#editar').on('show.bs.modal', function(e) {
		let proceso = $(e.relatedTarget).data().datos;
        let proceso_origen = $(e.relatedTarget).data().proceso;
        let subproceso_origen = $(e.relatedTarget).data().subproceso;
		$('#edit_proceso').val(proceso.nombre);
		$('#edit_codigo').val(proceso.codigo);
        $('#edit_descripcion').val(proceso.descripcion);
		$('#id_proceso').val(proceso.id);

        $('#proceso_o').val(proceso_origen.id);
        $('#subproceso_o').val(subproceso_origen.id);
	});


    $('#downloadFolder').on('show.bs.modal', function(e) {
		var proceso = $(e.relatedTarget).data().datos;
		console.log(proceso);
        $('#downloadFolder_id').val(proceso.id);
		$('#codigo_proceso').text(proceso.codigo);
    });

</script>

<script>
    $(document).ready(function(){
        $('.toast').toast('show')
    });
</script>


@endsection


