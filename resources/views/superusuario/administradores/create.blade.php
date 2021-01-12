<!--Modlal Crear -->
<div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-dark">
				<h5 class="modal-title" id="exampleModalLabel">Registrar nuevo administrador</h5>
				<span class="badge badge-danger" class="close"  data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times fa-lg" style="color:#fff"></i>
                </span>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{ route('administradores.store') }}">
					@csrf

                    <!-- from grup -->
					<div class="form-group">
						<label for="inicio">Nombre</label>
						<input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" autocomplete="off" >
						@if ($errors->has('name'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('name') }}</strong>
						</span>
						@endif
					</div>

                    <!-- from grup -->
					<div class="form-group">
						<label for="inicio">Apellido Paterno</label>
						<input type="text" name="apellido_paterno" class="form-control {{ $errors->has('apellido_paterno') ? ' is-invalid' : '' }}" autocomplete="off" >
						@if ($errors->has('apellido_paterno'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('apellido_paterno') }}</strong>
						</span>
						@endif
					</div>

                    <!-- from grup -->
					<div class="form-group">
						<label for="inicio">Apellido Materno</label>
						<input type="text" name="apellido_materno" class="form-control {{ $errors->has('apellido_materno') ? ' is-invalid' : '' }}" autocomplete="off" >
						@if ($errors->has('apellido_materno'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('apellido_materno') }}</strong>
						</span>
						@endif
					</div>

                    <!-- from grup -->
					<div class="form-group">
						<label for="inicio">E-Mail</label>
						<input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" autocomplete="off" >
						@if ($errors->has('email'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('email') }}</strong>
						</span>
						@endif
					</div>

                    <!-- from grup -->
					<div class="form-group">
						<label for="inicio">Contraseña</label>
						<input type="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" autocomplete="off" required>
						@if ($errors->has('password'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
						@endif
					</div>

					<!--confirma contraseña-->
					<div class="form-group">
						<label for="inicio">Confirma contraseña</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required >
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