@extends('layouts.admin')

@section('titulo','Procesos')

@section('contenido')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">

        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Procesos</h1>
          </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
              <li class="breadcrumb-item active" aria-current="page">Procesos</li>
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
                <h3 class="card-title">Tus procesos</h3>
                @if ((Auth::user()->rol_id) == 3)
                <div class="card-tools">
                    <a href="#" data-toggle="modal" data-target="#crear" class="btn btn-success btn-tool">Nuevo proceso</a>

                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>

                </div>
                @endif
                </div>
                <div class="card-body p-0" style="display: block;">
                <table class="table table-striped projects table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Codigo</th>
                            <th>Descripción</th>
                            <th>Subprocesos</th>
                            <th>Operaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                        @forelse($process as $proceso)
                        <tr>
                            <td>{{ ($process->currentPage() - 1) * $process->perPage() + $loop->iteration }}</td>
                            <td>{{  $proceso->nombre  }}</td>
                            <td>{{  $proceso->codigo  }}</td>
                            <td>
                                <button type="button" class="btn btn-success btn-circle btn-sm" data-container="body" data-toggle="popover" data-placement="right" data-content="{{ $proceso->descripcion }}">
                                    <i class="far fa-eye"></i>
                                </button>
                            </td>
                            <td>
                                <a class="btn btn-success btn-circle btn-sm" href="{{route('subproceso.byproceso',$proceso->id)}}" role="button">
                                    <i class="fas fa-angle-double-right"></i>
                                </a>
                            </td>
                            <td>
                                
                                    <a class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#eliminar"  href="#" data-datos="{{$proceso}}">
                                        <i class="fa fa-trash" ></i>
                                    </a>
                                

                                <a class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#editar" href="#" data-datos="{{$proceso}}" >
                                    <i class="fa fa-edit" ></i>
                                </a>

                                <a class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#downloadFolder" href="#" data-datos="{{$proceso}}" >
                                    <i class="fa fa-download"></i>
                                </a>

                            </td>
                        </tr>
                        @empty
                        <tr>
							<td colspan="6">Ningún proceso registrado.</td>
						</tr>
                        @endforelse
                    </tbody>
                </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{ $procesos->links() }}
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- Col -->


        

    </div>
    <!-- Row -->
</section>

@if ((Auth::user()->rol_id) == 3)
<a href="#" data-toggle="modal" data-target="#crear" class="btn btn-success back-to-top" role="button">
    <i class="fas fa-plus fa-lg"></i>
</a>
@endif


@include('administrador.procesos.create')
@include('administrador.procesos.delete')
@include('administrador.procesos.edit')
@include('administrador.procesos.downloadFolder')
@endsection

@section('scripts')
<script type="text/javascript">

    $(function () {
        $('[data-toggle="popover"]').popover()
    })



	$('#eliminar').on('show.bs.modal', function(e) {
		var proceso = $(e.relatedTarget).data().datos;
		console.log(proceso);
        $('#eliminarId').val(proceso.id);
		$('#nombre_proceso').text(proceso.codigo);
	});

    $('#editar').on('show.bs.modal', function(e) {
		var proceso = $(e.relatedTarget).data().datos;
		console.log(proceso);
		$('#edit_proceso').val(proceso.nombre);
		$('#edit_codigo').val(proceso.codigo);
        $('#edit_descripcion').val(proceso.descripcion);
		$('#id_proceso').val(proceso.id);
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
    })

</script>

@endsection




