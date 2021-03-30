<!--Modal Editar -->
<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-black">
				<h5 class="modal-title" id="exampleModalLabel">Editar plantel.</h5>
				<span class="badge badge-danger" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times fa-lg" style="color:#fff"></i>
				</span>
			</div>

			<div class="modal-body">
				<form method="POST" action="{{ route('planteles.update',1) }}">
					@csrf
					@method('PUT')
					<input type="hidden" name="id_plantel" id="id_plantel">

					<div class="ccontainer-fluid">
						<div class="row">
							<div class="col">
								<label for="municipio">Ubicaccion del plantel</label>
								<select class="custom-select mr-sm-2" name="municipio" id="select-municipio" required>
								</select>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="inicio">Numero del plantel</label>
						<input id="numero" required type="number" name="numero" class="form-control {{ $errors->has('numero') ? ' is-invalid' : '' }}" autocomplete="off" value="{{ old('numero') }}">
						@if ($errors->has('numero'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('numero') }}</strong>
						</span>
						@endif
					</div>

					<div class="form-group">
						<label for="inicio">Clave de trabajo</label>
						<input id="clave_trabajo" required type="text" name="clave_trabajo" class="form-control {{ $errors->has('clave_trabajo') ? ' is-invalid' : '' }}" autocomplete="off" value="{{ old('clave_trabajo') }}">
						@if ($errors->has('clave_trabajo'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('clave_trabajo') }}</strong>
						</span>
						@endif
					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-primary btn-block">Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>