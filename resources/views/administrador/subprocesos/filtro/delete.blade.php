<!-- eliminar Modal-->
<div class="modal fade" id="eliminar_fitro_subproceso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-black">
				<h5 class="modal-title" id="exampleModalLabel">¿Seguro que quieres eliminar el subproceso <span class="badge badge-danger" id="nombre_subproceso"></span>?</h5>
                
				
                    <span class="badge badge-danger" class="close"  data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times fa-lg" style="color:#fff"></i>
                    </span>
			
                
			</div>
			<form  method="POST" action="{{ route('subprocesos.destroy.byproceso',0) }}" role="form" >

                
				<div class="modal-body">Se eliminaran los archivos internos de este subproceso
                        
						<input class="form-control {{ $errors->delete->has('contraseña') ? ' is-invalid' : '' }}" type="password" name="contraseña" placeholder="Coloca tu contraseña para confirmar">
						@if ($errors->delete->has('contraseña'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->delete->first('contraseña') }}</strong>
							</span>
						@endif
						<input type="hidden" name="id" id="eliminarId">
				</div>

				<input type="hidden" name="id_user" value={{Auth::user()->id}}>

				<div class="modal-footer">
                        @csrf
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-danger">Eliminar</button>
				</div>
			</form>
				
		</div>
	</div>
</div>