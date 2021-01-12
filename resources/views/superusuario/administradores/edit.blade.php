<!--Modal Editar -->
<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-black">
				<h5 class="modal-title" id="exampleModalLabel">Editar administrador.</h5>
					<span class="badge badge-danger" class="close"  data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times fa-lg" style="color:#fff"></i>
                    </span>
			</div>

			<div class="modal-body">
				<form method="POST" action="{{ route('administradores.update',1) }}">
					@csrf
					@method('PUT')
					<input  type="hidden" name="id" id="id_usuario">
					
					<div class="form-group">
						<label for="inicio">Nombre del Administrador</label>
						<input id="user_name" required type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" autocomplete="off" value="{{ old('name') }}" >
						@if ($errors->has('name'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('name') }}</strong>
						</span>
						@endif
					</div>
					
					<div class="form-group">
						<label for="inicio">Apellido Paterno del Administrador</label>
						<input id="apellido_paterno" required type="text" name="apellido_paterno" class="form-control {{ $errors->has('apellido_paterno') ? ' is-invalid' : '' }}" autocomplete="off" value="{{ old('apellido_paterno') }}" >
						@if ($errors->has('apellido_paterno'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('apellido_paterno') }}</strong>
						</span>
						@endif
					</div>
					
					<div class="form-group">
						<label for="inicio">Apellido Materno del Administrador</label>
						<input id="apellido_materno" required type="text" name="apellido_materno" class="form-control {{ $errors->has('apellido_materno') ? ' is-invalid' : '' }}" autocomplete="off" value="{{ old('apellido_materno') }}" >
						@if ($errors->has('apellido_materno'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('apellido_materno') }}</strong>
						</span>
						@endif
					</div>

					<div class="form-group">
						<label for="inicio">Correo</label>
						<input id="email" required type="text" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" autocomplete="off" value="{{ old('email') }}" >
						@if ($errors->has('email'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('email') }}</strong>
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