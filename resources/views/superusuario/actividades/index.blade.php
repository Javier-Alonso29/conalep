@extends('layouts.admin')

@section('titulo','Historial de actividad')

@section('contenido')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">

        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Historial de actividad de los administradores</h1>
          </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
              <li class="breadcrumb-item active" aria-current="page">Actividad</li>
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
                <h3 class="card-title">Historial de actividad</h3>

                <div class="card-tools">
                    <div class="btn btn-tool">
                        <select class="form-select form-select-sm" id="filtro_id" name="filtro_id">
                            <option >----------</option>
                            <option value="1" @if(old('filtro_id', $post) === "1")  selected @endif>Hoy</option>
                            <option value="2" @if(old('filtro_id', $post) === "2")  selected @endif>Ayer</option>
                            <option value="3" @if(old('filtro_id', $post) === "3")  selected @endif>Últimos 7 días</option>
                            <option value="4" @if(old('filtro_id', $post) === "4")  selected @endif>Este mes</option>
                            <option value="5" @if(old('filtro_id', $post) === "5")  selected @endif>Últimos tres meses</option>
                        </select>
                    </div>
                    <div class="btn btn-tool">
                        <a href="#" data-toggle="modal" data-target="#filtrar" class="btn btn-success btn-block">Aplicar filtro</a>
                    </div>
                </div>
               
                </div>
                <div class="card-body p-0" style="display: block;">
                <table class="table table-striped projects table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Usuario</th>
                            <th>Plantel</th>
                            <th>Acción realizada</th>
                            <th>Fecha y hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($actividades->reverse() as $actividad)
                        <tr>
                            <td>{{$actividad->id}}</td>
                            <td>{{$actividad->usuario->name}} {{$actividad->usuario->apellido_paterno}} {{$actividad->usuario->apellido_materno}}</td>
                            <td>ZACATECAS</td>
                            <td>{{$actividad->accion}}</td>
                            <td>{{$actividad->created_at}}</td>
                        </tr>
                        @empty
                        <tr>
							<td colspan="5">Ninguna actividad se ha realizado.</td>
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


@include('superusuario.actividades.filtrar')
@endsection

@section('scripts')

<script type="text/javascript">
    $('#eliminar').on('show.bs.modal', function(e) {

    });


    $('#filtrar').on('show.bs.modal', function(e) {
        var filtrar = document.getElementById("filtro_id");
        console.log(filtrar.value);
        var valor = filtrar.value;
        $('#filtrar_id').val(valor);
    });
</script>




@stop