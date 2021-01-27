<!--Modal Editar -->
<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-black">
				<h5 class="modal-title" id="exampleModalLabel">Editar permisos de administrador.</h5>
					<span class="badge badge-danger" class="close"  data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times fa-lg" style="color:#fff"></i>
                    </span>
			</div>

			<div class="modal-body">
				<form method="POST" action="{{ route('permisos.update',1) }}">
					@csrf
					@method('PUT')
					
                    <div class="ccontainer-fluid">
						<div class="row">
							<div class="col">
								<label for="id_plantelplantel">Plantel</label>
								<select class="custom-select mr-sm-2" name="id_plantel" id="select-plantel" required>
								</select>
							</div>
						</div>
                    </div>
                    
                    <div class="ccontainer-fluid">
						<div class="row">
							<div class="col">
								<label for="id_proceso">Proceso</label>
								<select class="custom-select mr-sm-2" name="id_proceso" id="select-proceso" required>
								</select>
							</div>
						</div>
                    </div>
                    
                    <div class="ccontainer-fluid">
						<div class="row">
							<div class="col">
								<label for="id_user">Administrador</label>
								<select class="custom-select mr-sm-2" name="id_user" id="select-usuario" required>
								</select>
							</div>
						</div>
                    </div>
                    

                    <div class="ccontainer-fluid">
						<div class="row">
							<div class="col">
								<label for="leer">Permiso de lectura de archivos</label>
								<select class="custom-select mr-sm-2" name="leer" id="select-leer" required>
								</select>
							</div>
						</div>
                    </div>
                    

                    <div class="ccontainer-fluid">
						<div class="row">
							<div class="col">
								<label for="descargar">Permiso de descarga de archivos</label>
								<select class="custom-select mr-sm-2" name="descargar" id="select-descargar" required>
								</select>
							</div>
						</div>
                    </div>
                    
                    <div class="ccontainer-fluid">
						<div class="row">
							<div class="col">
								<label for="subir">Permiso de subida de archivos</label>
								<select class="custom-select mr-sm-2" name="subir" id="select-subir" required>
								</select>
							</div>
						</div>
					</div>
                    
                    
                    <div class="ccontainer-fluid">
						<div class="row">
							<div class="col">
								<label for="borrar">Permiso de lectura de archivos</label>
								<select class="custom-select mr-sm-2" name="borrar" id="select-borrar" required>
								</select>
							</div>
						</div>
					</div>

					
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary btn-block">Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>