<!--Modal Editar -->
<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-black">
				<h5 class="modal-title" id="exampleModalLabel">Editar ciclo escolar.</h5>
				<span class="badge badge-danger" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times fa-lg" style="color:#fff"></i>
				</span>
			</div>

			<div class="modal-body">
				<form method="POST" action="{{ route('ciclos.update',1) }}">
					@csrf
					@method('PUT')
					<input type="hidden" name="id" id="id">


					<div class="form-group">
						<label for="inicio">Nombre del ciclo esoclar</label>
						<input id="nombre" required type="text" name="nombre" class="form-control {{ $errors->has('nombre') ? ' is-invalid' : '' }}" autocomplete="off" value="{{ old('nombre') }}">
						@if ($errors->has('nombre'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('nombre') }}</strong>
						</span>
						@endif
					</div>

                    <div class="form-group">
						<label for="inicio">Inicio del ciclo escolar</label>
						<input id="inicio" required type="number" name="inicio" class="form-control {{ $errors->has('inicio') ? ' is-invalid' : '' }}" autocomplete="off" value="{{ old('inicio') }}">
						@if ($errors->has('inicio'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('incio') }}</strong>
						</span>
						@endif
					</div>

                    <div class="form-group">
						<label for="inicio">Conclusión del ciclo escolar</label>
						<input id="conclusion" required type="number" name="conclusion" class="form-control {{ $errors->has('conclusion') ? ' is-invalid' : '' }}" autocomplete="off" value="{{ old('conclusion') }}">
						@if ($errors->has('conclusion'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('conclusion') }}</strong>
						</span>
						@endif
					</div>


					<input type="hidden" name="id_user" value={{Auth::user()->id}}>
					
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary btn-block">Guardar</button>