@extends('layouts.admin')

@section('titulo','Procesos Personales')

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
              <li class="breadcrumb-item"><a>Procesos</a></li>
              <li class="breadcrumb-item"><a>Sub procesos</a></li>
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
                    <a href="#" data-toggle="modal" data-target="#crear" class="btn btn-success btn-tool">Nuevo proceso personal</a>

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
                            <th>Documentos</th>
                            <th>Operaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($procesos_personales as $procesopers)
                            <tr>
                                <td>{{  $loop->iteration  }}</td>
                                <td>{{  $procesopers->nombre  }}</td>
                                <td>{{  $procesopers->codigo  }}</td>
                                <td>
                                    <button type="button" class="btn btn-success btn-circle btn-sm" data-container="body" data-toggle="popover" data-placement="right" data-content="{{ $procesopers->descripcion }}">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </td>
                                <td>
                                    <a class="btn btn-success btn-circle btn-sm" href="{{ route('documentos.byProcesoPersonal', $procesopers->id) }}" role="button">
                                        <i class="fas fa-angle-double-right"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#editar" href="#" data-datos="{{$procesopers}}" >
                                        <i class="fa fa-edit" ></i>
                                    </a>
                                    
                                    <a class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#downloadFolder" href="#" data-datos="{{$procesopers}}" >
                                        <i class="fa fa-download"></i>
                                    </a>
                                    
                                    <a class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#eliminar"  href="#" data-datos="{{$procesopers}}">
                                        <i class="fa fa-trash" ></i>
                                    </a>
                                    
                                </td>
                            </tr>
                        @empty
                        <tr>
							<td colspan="5">Ningún proceso personal registrado.</td>
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
@include('administrador.personales.downloadFolder')

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
        $('#proceso_origen').val(proceso.id_proceso);
        $('#subproceso_origen').val(proceso.id_subproceso);
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

        $('#proceso_o').val(proceso.id_proceso);
        $('#subproceso_o').val(proceso.id_subproceso);
	});


    $('#downloadFolder').on('show.bs.modal', function(e) {
		var procesopers = $(e.relatedTarget).data().datos;
		console.log(procesopers);
        $('#downloadFolder_id').val(procesopers.id);
		$('#codigo_procesopersonal').text(procesopers.codigo);
    });

</script>

<script>
    $(document).ready(function(){
        $('.toast').toast('show')
    });
</script>


@endsection


