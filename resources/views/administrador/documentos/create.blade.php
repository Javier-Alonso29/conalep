<!--Modal Crear -->
<div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-dark">
				<h5 class="modal-title" id="exampleModalLabel">Registrar nuevo documento</h5>
				<span class="badge badge-danger" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times fa-lg" style="color:#fff"></i>
				</span>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{ route('documentos.store') }}" enctype="multipart/form-data">
					@csrf

					<!-- from grup -->
					<div class="form-group">
						<label for="inicio">Nombre del documento</label>
						<input type="text" name="nombre" class="form-control {{ $errors->has('nombre') ? ' is-invalid' : '' }}" autocomplete="off">
						@if ($errors->has('nombre'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('nombre') }}</strong>
						</span>
						@endif
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col">
								<label for="archivo">Archivo</label>
								<input type="file" name="archivo">
							</div>
						</div>
					</div>

					@if ($errors->has('id_tipodocumento'))
					<div role="alert">{{ $errors->first('id_tipodocumento') }}</div>
					@endif

					<div class="form-group">
						<div class="row">
							<div class="col">
								<label for="id_tipodocumento">Tipo de Documento</label>
								<select class="custom-select mr-sm-2" name="id_tipodocumento" required>
									@foreach($tipodocumentos as $tipo)
									<option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>

					@if ($errors->has('id_subproceso'))
					<div role="alert">{{ $errors->first('id_subproceso') }}</div>
					@endif

					<div class="form-group">
						<div class="row">
							<div class="col">
								<label for="id_subproceso">Proceso personal</label>
								<select class="custom-select mr-sm-2" name="proceso_personal" required>
									@foreach($procesos_personales_array as $proceso_personal)
										<option value="{{$proceso_personal->id}}">{{$proceso_personal->codigo}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col">
								<label for="id_subproceso">Ciclo</label>
								<select class="custom-select mr-sm-2" name="ciclo" required>
									<option selected value> ---- </option>
									@foreach($ciclos as $ciclo)
									<option value="{{$ciclo->id}}">{{$ciclo->nombre}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>

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