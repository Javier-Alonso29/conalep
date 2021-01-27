@extends('layouts.admin')

@section('titulo','Planteles')

@section('contenido')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">

        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Planteles</h1>
          </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
              <li class="breadcrumb-item active" aria-current="page">Planteles</li>
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
                <h3 class="card-title">Planteles registrados</h3>

                <div class="card-tools">
                    <div class="btn btn-tool">
                        <a href="" data-toggle="modal" data-target="#crear" class="btn btn-success btn-block">Nuevo plantel</a>
                    </div>
                </div>
                </div>
                <div class="card-body p-0" style="display: block;">
                <table class="table table-striped projects table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Numero de plantel</th>
                            <th>Clave de trabajo</th>
                            <th>Municipio</th>
                            <th>Operaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($planteles as $plantel)
                        <tr>
                            <td>{{  $loop->iteration  }}</td>
                            <td>{{ $plantel->numero }}</td>
                            <td>{{  $plantel->clave_trabajo  }}</td>
                            <td>{{ $plantel->municipio->nombre }}</td>
                            <td>
                                <a class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#eliminar"  href="#" data-datos="{{$plantel}}">
                                    <i class="fa fa-trash" ></i>
                                </a>
                                
                                <button  class="btn btn-info btn-circle btn-sm" data-toggle="modal" data-target="#editar" id="btn-edit-plantel" href="#" data-datos="{{$plantel}}" >
                                    <i class="fa fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
							<td colspan="5">Ningún plantel registrado.</td>
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

@include('superusuario.planteles.create')
@include('superusuario.planteles.delete')
@include('superusuario.planteles.edit')
@endsection

@section('scripts')
<script type="text/javascript">

	$('#eliminar').on('show.bs.modal', function(e) {
		var plantel = $(e.relatedTarget).data().datos;
        $('#eliminarId').val(plantel.id);
		$('#numero_plantel').text(plantel.numero);
    });

    $('#editar').on('show.bs.modal', function(e) {

        var plantel = $(e.relatedTarget).data().datos;

        //AJAX
        $.get('/api/planteles/municipio', function(data){

            var municipio_plantel = plantel.municipio.nombre;
            var html_select;
            
            for (var i = 0; i<data.length; i++)
                
                if(municipio_plantel == data[i].nombre)

                    html_select += '<option value="'+data[i].id+'" selected>'+data[i].nombre+'</option>';   

                else
                html_select += '<option value="'+data[i].id+'">'+data[i].nombre+'</option>';   

            $('#select-municipio').html(html_select);
        });

        
		$('#numero').val(plantel.numero);
		$('#clave_trabajo').val(plantel.clave_trabajo);
		$('#id_plantel').val(plantel.id);
        $('#municipio').val(plantel.municipio_id);
    });

</script>

@stop




