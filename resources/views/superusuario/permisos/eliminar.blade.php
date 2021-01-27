<!--Modal Eliminar-->
<div class="modal fade" id="eliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-black">
				<h5 class="modal-title" id="exampleModalLabel">¿Seguro que quieres quitar los permisos al administrador <span class="badge badge-danger" id="nombre_usuario_delete"></span>?</h5>
                    <span class="badge badge-danger" class="close"  data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times fa-lg" style="color:#fff"></i>
                    </span>
			</div>
			
			<form  method="POST" action="{{ route('permisos.eliminar',0) }}" role="form" >

				@csrf

				<div class="modal-body">Inserte su contraseña para quitar permiso
                        
						<input class="form-control {{ $errors->delete->has('contraseña') ? ' is-invalid' : '' }}" type="password" name="contraseña" placeholder="Coloca tu contraseña para confirmar">
						@if ($errors->delete->has('contraseña'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->delete->first('contraseña') }}</strong>
							</span>
						@endif
						
						<input type="hidden" name="id_user" id="id_user" required>

						<input type="hidden" name="id_plantel" id="id_plantel" required>

						<input type="hidden" name="id_proceso" id="id_proceso" required>
				</div>
				<div class="modal-footer">
                       
                        
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-danger">Eliminar</button>
				</div>
			</form>
				
		</div>
	</div>
</div>