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
        
            <div class="card ">
                <div class="card-header bg-dark">
                <h3 class="card-title">Subprocesos</h3>

                @if ((Auth::user()->rol_id) == 3)
                <div class="card-tools">
                    <a href="#" data-toggle="modal" data-target="#crear" class="btn btn-success btn-tool">Nuevo subproceso</a>

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
                            <th>Proceso</th>
                            @if ((Auth::user()->rol_id) == 3)
                                <th>Operaciones</th>
                            @else
                                
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subprocesos as $subproceso)
                        <tr>
                            <td>{{ ($subprocesos->currentPage() - 1) * $subprocesos->perPage() + $loop->iteration }}</td>
                            <td>{{  $subproceso->nombre  }}</td>
                            <td>{{  $subproceso->codigo  }}</td>
                            <td>{{  $subproceso->proceso['nombre']  }}</td>
                            <td>
                                @if ((Auth::user()->rol_id) == 3)
                                <a class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#eliminar"  href="#" data-datos="{{$subproceso}}">
                                    <i class="fa fa-trash" ></i>
                                </a>

                                <a class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#editar" href="#" data-datos="{{$subproceso}}" >
                                    <i class="fa fa-edit" ></i>
                                </a>

                                <a class="btn btn-primary btn-circle btn-sm" data-toggle="modal" data-target="#downloadFolder" href="#" data-datos="{{$subproceso}}" >
                                    <i class="fa fa-download"></i>
                                </a>
                                @endif


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




