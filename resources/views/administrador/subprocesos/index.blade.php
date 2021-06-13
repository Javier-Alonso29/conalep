@extends('layouts.admin')

@section('titulo','Subprocesos')

@section('contenido')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">

        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Subprocesos</h1>
          </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
              <li class="breadcrumb-item active" aria-current="page">Subprocesos</li>
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
                <small>Proceso</small>
                <button data-dismiss="toast" type="button" class="ml-2 mb-1 close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="toast-body">{{session('success')}}</div>
        </div>
</div>
@endif

@if(session('error'))
<div id="toastsContainerTopRight" class="toasts-top-right fixed"><div class="toast bg-danger fade show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="6000">
    <div class="toast-header">
        <strong class="mr-auto">¡Error! ...</strong>
        <small>Proceso</small>
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
                <h3 class="card-title">Subprocesos</h3>

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
                            <th>Proceso</th>
                            <th>Operaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subprocesos as $subproceso)
                        <tr>
                            <td>{{  $loop->iteration  }}</td>
                            <td>{{  $subproceso->nombre  }}</td>
                            <td>{{  $subproceso->codigo  }}</td>
                            <td>{{  $subproceso->proceso['nombre']  }}</td>
                            <td>
                                <a class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#eliminar"  href="#" data-datos="{{$subproceso}}">
                                    <i class="fa fa-trash" ></i>
                                </a>

                                <a class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#editar" href="#" data-datos="{{$subproceso}}" >
                                    <i class="fa fa-edit" ></i>
                                </a>

                                <a class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#downloadFolder" href="#" data-datos="{{$subproceso}}" >
                                    <i class="fa fa-download"></i>
                                </a>

                            </td>
                        </tr>
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
                    {{$subprocesos->links()}}
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- Col -->

        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-dark">Operaciones Generales</div>
                <div class="card-body">
                    <p class="card-text">Operaciones generales que puedes hacer a todos los subprocesos registrados</p>
                </div>
                @if ((Auth::user()->rol_id) == 3)

                <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="" data-toggle="modal" data-target="#crear" class="btn btn-success btn-block">Nuevo subproceso</a></li>
                        <li class="list-group-item"><a href="#" class="btn btn-danger btn-block">Borrar todos</a></li>
                </ul>
                    
                @elseif ((Auth::user()->rol_id) == 1)

                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="" data-toggle="modal" data-target="#crear" class="btn btn-success btn-block">Nuevo subproceso</a></li>
                </ul>
                    
                @else

                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="" data-toggle="modal" data-target="#crear" class="btn btn-success btn-block">Nueva carpeta</a></li>
                </ul>

                @endif
                <div class="card-footer text-center">Subprocesos</div>
            </div>
        </div>
        <!-- Col -->

    </div>
    <!-- Row -->
</section>


@include('administrador.subprocesos.create')
@include('administrador.subprocesos.delete')
@include('administrador.subprocesos.edit')
@include('administrador.subprocesos.downloadFolder')
@endsection

@section('scripts')
<script type="text/javascript">


	$('#eliminar').on('show.bs.modal', function(e) {
		var subproceso = $(e.relatedTarget).data().datos;
		console.log(subproceso);
        $('#eliminarId').val(subproceso.id);
		$('#nombre_subproceso').text(subproceso.codigo);
	});

    $('#editar').on('show.bs.modal', function(e) {
		var subproceso = $(e.relatedTarget).data().datos;
		console.log(subproceso);
		$('#edit_subproceso').val(subproceso.nombre);
		$('#edit_codigo').val(subproceso.codigo);
        $('#edit_descripcion').val(subproceso.descripcion);
		$('#id_subproceso').val(subproceso.id);
	});


    $('#downloadFolder').on('show.bs.modal', function(e) {
		var subproceso = $(e.relatedTarget).data().datos;
		console.log(subproceso);
        $('#downloadFolder_id').val(subproceso.id);
		$('#codigo_subproceso').text(subproceso.codigo);
    });
    

</script>

<script>
    $(document).ready(function(){
        $('.toast').toast('show')
    })

</script>

@stop




