<!--Modlal Crear -->
<div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-black">
				<h5 class="modal-title" id="exampleModalLabel">Asignar permisos</h5>
				<span class="badge badge-danger" class="close"  data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times fa-lg" style="color:#fff"></i>
                </span>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{ route('permisos.store')}}">
					@csrf

					

					<div class="ccontainer-fluid">
						<div class="row">
							<div class="col">
								<label for="id_plantel">Plantel</label>
								<select class="custom-select mr-sm-2" name="id_plantel" required>
									@foreach($planteles as $plantel)
										<option value="{{$plantel->id}}">{{$plantel->clave_trabajo}}</option>
									@endforeach
								</select>
							</div>
						</div>
                    </div>
                    

                    <div class="ccontainer-fluid">
						<div class="row">
							<div class="col">
								<label for="id_proceso">Proceso</label>
								<select class="custom-select mr-sm-2" name="id_proceso" required>
									@foreach($procesos as $proceso)
										<option value="{{$proceso->id}}">{{$proceso->nombre}}</option>
									@endforeach
								</select>
							</div>
						</div>
                    </div>
                    
                    <div class="ccontainer-fluid">
						<div class="row">
							<div class="col">
								<label for="id_user">Administrador</label>
								<select class="custom-select mr-sm-2" name="id_user" required>
									@foreach($usuarios as $usuario)
										<option value="{{$usuario->id}}">{{$usuario->name}} {{$usuario->apellido_paterno}} {{$usuario->apellido_materno}}</option>
									@endforeach
								</select>
							</div>
						</div>
                    </div>
                    
                    <div class="ccontainer-fluid">
						<div class="row">
							<div class="col">
								<label for="leer">Permiso de lectura de archivos</label>
								<select class="custom-select mr-sm-2" name="leer" >
                                        <option type="number" value="0">No Permitido</option>
                                        <option type="number" value="1">Permitido</option>
								</select>
							</div>
						</div>
                    </div>

                    <div class="ccontainer-fluid">
						<div class="row">
							<div class="col">
								<label for="descargar">Permiso de descarga de archivos</label>
								<select class="custom-select mr-sm-2" name="descargar" >
                                        <option type="number" value="0">No Permitido</option>
                                        <option type="number" value="1">Permitido</option>
								</select>
							</div>
						</div>
                    </div>

                    <div class="ccontainer-fluid">
						<div class="row">
							<div class="col">
								<label for="subir">Permiso de subida de archivos</label>
								<select class="custom-select mr-sm-2" name="subir" >
                                        <option type="number" value="0">No Permitido</option>
                                        <option type="number" value="1">Permitido</option>
								</select>
							</div>
						</div>
                    </div>


                    <div class="ccontainer-fluid">
						<div class="row">
							<div class="col">
								<label for="borrar">Permiso de borrado de archivos</label>
								<select class="custom-select mr-sm-2" name="borrar" >
                                        <option type="number" value="0">No Permitido</option>
                                        <option type="number" value="1">Permitido</option>
								</select>
							</div>
						</div>
                    </div>
                    


                    

					<!-- from grup -->
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