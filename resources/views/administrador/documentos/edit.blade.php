<!--Modal Editar -->
<div class="modal fade" id="editar-documento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-black">
				<h5 class="modal-title" id="exampleModalLabel">Editar documento</h5>
				<span class="badge badge-danger" class="close" data-dismiss="modal" aria-label="Close">
					<i class="fas fa-times fa-lg" style="color:#fff"></i>
				</span>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{ route('documentos.update',1) }}">
					@csrf
					@method('PUT')
					<input type="hidden" name="id" id="documento_id">

					<div class="form-group">
						<label for="nombre">Nombre del documento</label>
						<input required type="text" id="documento_nombre" name="nombre" class="form-control {{ $errors->has('nombre') ? ' is-invalid' : '' }}" autocomplete="off" value="{{ old('nombre') }}">
						@if ($errors->has('nombre'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('nombre') }}</strong>
						</span>
						@endif
					</div>

					<div class="ccontainer-fluid">
						<div class="row">
							<div class="col">
								<label for="id_tipodocumento">Tipo del documento</label>
								<select class="custom-select mr-sm-2" name="tipo_documento" id="tipodocumento_select" required>
									@foreach($tipodocumentos as $tipo)
									<option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>

					<div class="ccontainer-fluid">
						<div class="row">
							<div class="col">
								<label for="id_subproceso">Subproceso</label>
								<select class="custom-select mr-sm-2" name="subproceso" id="subproceso_select" required>
									@foreach($subprocesos as $subp)
									<option value="{{$subp->id}}">{{$subp->nombre}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>

					<div class="modal-footer">
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>