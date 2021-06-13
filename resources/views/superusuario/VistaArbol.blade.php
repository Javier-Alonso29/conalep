@section('css')
<link href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/jquery-treegrid@0.3.0/css/jquery.treegrid.css" rel="stylesheet">

<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-treegrid@0.3.0/js/jquery.treegrid.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/extensions/treegrid/bootstrap-table-treegrid.min.js"></script>
@endsection

@extends('layouts.admin')

@section('titulo','Arbol de procesos')

@section('contenido')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">

        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Arbol de procesos</h1>
        </div>

        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
              <li class="breadcrumb-item active" aria-current="page">Arbol</li>
            </ol>
        </div>

      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="container">
    <div class="row">
        <div class="col-md-12">
        
            <div class="card">
                <div class="card-header bg-dark">
                <h3 class="card-title">Arbol de procesos</h3>
               
                </div>
                <div class="card-body p-0" style="display: block;">
                <table class="table table-bordered table-striped" >
                    <thead>
                        <tr>
                            <th>Proceso</th>
                            <th>Subproceso</th>
                            <th>Documentos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($procesos as $proceso)
                            <tr>
                                <td>{{$proceso->nombre}}</td>
                                <td>
                                    @foreach ($subprocesos as $subproceso)
                                        @foreach ($subproceso as $sb)
                                            @if ($sb->id_proceso === $proceso->id)
                                                <ol>{{$sb->nombre}}</ol>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($subprocesos as $subproceso)
                                        @foreach ($subproceso as $sb)
                                            @foreach ($documentos as $documento)
                                                @foreach ($documento as $doc)
                                                    @if (($sb->id === $doc->id_subproceso) && ($sb->id_proceso === $proceso->id))
                                                        <ol>{{$doc->nombre}}</ol>
                                                        @continue
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- Col -->

    </div>
</div>
    <!-- Row -->
</section>

@endsection
