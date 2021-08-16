<!--Modal Cambiar Password -->
<div class="modal fade" id="cambiar-pass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-black">
				<h5 class="modal-title" id="exampleModalLabel">Cambiar contraseña del administrador.</h5>
					<span class="badge badge-danger" class="close"  data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times fa-lg" style="color:#fff"></i>
                    </span>
			</div>

			<div class="modal-body">
				<form method="GET" action="{{ route('administradores.cambiarpass',1) }}">
					@csrf
					@method('GET')
					<input  type="hidden" name="id" id="id_usuario_cambio">
					
					

					<div class="form-group">
						<label for="inicio">Nueva Contraseña</label>
						<input id="new_password" required type="password" name="new_password" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" autocomplete="off" value="{{ old('email') }}" >
						@if ($errors->has('new_password'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('new_password') }}</strong>
						</span>
						@endif
					</div>

                    <div class="form-group">
						<label for="inicio">Confirmar Contraseña</label>
						<input id="confirm_password" required type="password" name="confirm_password" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" autocomplete="off" value="{{ old('email') }}" >
						@if ($errors->has('confirm_password'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('confirm_password') }}</strong>
						</span>
						@endif
					</div>

					<input type="hidden" name="id_user" value={{Auth::user()->id}}>
					
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary btn-block">Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>