<!--Modal Editar -->
<div class="modal fade" id="editar-tipodocumento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-black">
				<h5 class="modal-title" id="exampleModalLabel">Editar tipo de documento</h5>
				<span class="badge badge-danger" class="close"  data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times fa-lg" style="color:#fff"></i>
                    </span>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{ route('tipodocumento.update',1) }}">
					@csrf
					@method('PUT')
					<input  type="hidden" name="id" id="id_tipodocumento">
					
					<div class="form-group">
						<label for="inicio">Nombre del tipo de documento</label>
						<input required type="text" id="edit_tipodocumento" name="nombre" class="form-control {{ $errors->has('nombre') ? ' is-invalid' : '' }}" autocomplete="off" value="{{ old('nombre') }}" >
						@if ($errors->has('nombre'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('nombre') }}</strong>
						</span>
						@endif
					</div>

					<div class="form-group">
						<label for="inicio">Codigo del tipo de documento</label>
						<input required type="text" id="edit_codigo" name="codigo" class="form-control {{ $errors->has('codigo') ? ' is-invalid' : '' }}" autocomplete="off" value="{{ old('codigo') }}" >
						@if ($errors->has('codigo'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('codigo') }}</strong>
						</span>
						@endif
					</div>

					<div class="form-group">
						<label for="inicio">Descripcion</label>
                        <textarea class="form-control" autocomplete="off" value="{{ old('descripcion') }}" aria-label="With textarea" name="descripcion" id="edit_descripcion"></textarea>
						@if ($errors->has('descripcion'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('descripcion') }}</strong>
						</span>
						@endif
					</div>
					
					<input type="hidden" name="id_user" value={{Auth::user()->id}}>

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