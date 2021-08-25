<!--Modlal Crear -->
<div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-black">
				<h5 class="modal-title" id="exampleModalLabel">Registrar nuevo plantel</h5>
				<span class="badge badge-danger" class="close"  data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times fa-lg" style="color:#fff"></i>
                </span>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{ route('planteles.store') }}">
					@csrf

					<!-- from grup -->
					<div class="form-group">
						<label for="nombre_plantel">Nombre del plantel</label>
						<input type="text" name="nombre_plantel" class="form-control {{ $errors->has('nombre_plantel') ? ' is-invalid' : '' }}" autocomplete="off" >
						@if ($errors->has('nombre_plantel'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('nombre_plantel') }}</strong>
						</span>
						@endif
					</div>

					@if ($errors->has('municipio'))
						<div role="alert">{{ $errors->first('municipio') }}</div>
					@endif

					<div class="ccontainer-fluid">
						<div class="row">
							<div class="col">
								<label for="municipio">Ubicaccion del plantel</label>
								<select class="custom-select mr-sm-2" name="municipio" required>
									@foreach($municipios as $municipio)
										<option value="{{$municipio->id}}">{{$municipio->nombre}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>

                    <!-- from grup -->
					<div class="form-group">
						<label for="numero">Numero de plantel</label>
						<input type="number" name="numero" class="form-control {{ $errors->has('numero') ? ' is-invalid' : '' }}" autocomplete="off" >
						@if ($errors->has('numero'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('numero') }}</strong>
						</span>
						@endif
					</div>

                    <!-- from grup -->
					<div class="form-group">
						<label for="clave_trabajo">Clave de trabajo</label>
						<input type="text" name="clave_trabajo" class="form-control {{ $errors->has('clave_trabajo') ? ' is-invalid' : '' }}" autocomplete="off" >
						@if ($errors->has('clave_trabajo'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('clave_trabajo') }}</strong>
						</span>
						@endif
					</div>

					<input type="hidden" name="id_user" value={{Auth::user()->id}}>

					<!-- from grup -->
					<div class="modal-footer">
						<div class="form-group">
							<button type="submit" class="btn btn-success">Guardar</button>
						</div>
					</div>
					
				</form>
			</div>
		</div>
	</div>
</div>