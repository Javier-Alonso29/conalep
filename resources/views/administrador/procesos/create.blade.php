<!--Modlal Crear -->
<div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-dark">
				<h5 class="modal-title" id="exampleModalLabel">Registrar nuevo proceso</h5>
				<span class="badge badge-danger" class="close"  data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times fa-lg" style="color:#fff"></i>
                </span>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{ route('procesos.store') }}">
					@csrf

                    <!-- from grup -->
					<div class="form-group">
						<label for="inicio">Nombre del proceso</label>
						<input type="text" name="nombre" class="form-control {{ $errors->has('nombre') ? ' is-invalid' : '' }}" autocomplete="off" >
						@if ($errors->has('nombre'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('nombre') }}</strong>
						</span>
						@endif
					</div>

                    <!-- from grup -->
					<div class="form-group">
						<label for="inicio">Codigo del procceso</label>
						<input type="text" name="codigo" class="form-control {{ $errors->has('codigo') ? ' is-invalid' : '' }}" autocomplete="off" >
						@if ($errors->has('codigo'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('codigo') }}</strong>
						</span>
						@endif
					</div>

					<!-- from grup -->
					<div class="form-group">
						<label for="inicio">Descripcion</label>
						<textarea class="form-control" aria-label="With textarea" name="descripcion"></textarea>
					</div>

					<input type="hidden" name="id_user" value={{Auth::user()->id}}>

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