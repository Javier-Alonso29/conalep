<!--Modal Crear -->
<div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-black">
				<h5 class="modal-title" id="exampleModalLabel">Registrar nuevo ciclo escolar</h5>
				<span class="badge badge-danger" class="close"  data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times fa-lg" style="color:#fff"></i>
                </span>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{ route('ciclos.store') }}">
					@csrf

					<!-- form group -->
					<div class="form-group">
						<label for="nombre">Nombre del ciclo escolar</label>
						<input type="text" name="nombre" class="form-control {{ $errors->has('nombre') ? ' is-invalid' : '' }}" autocomplete="off" >
						@if ($errors->has('nombre'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('nombre') }}</strong>
						</span>
						@endif
					</div>


                    <!-- form group -->
					<div class="form-group">
						<label for="numero">Inicio del ciclo escolar</label>
						<input type="number" name="inicio" class="form-control {{ $errors->has('inicio') ? ' is-invalid' : '' }}" autocomplete="off" >
						@if ($errors->has('inicio'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('inicio') }}</strong>
						</span>
						@endif
					</div>


                    <!-- form group -->
					<div class="form-group">
						<label for="numero">Conclusion del ciclo escolar</label>
						<input type="number" name="conclusion" class="form-control {{ $errors->has('conclusion') ? ' is-invalid' : '' }}" autocomplete="off" >
						@if ($errors->has('conclusion'))
						<span class="invalid-feedback" role="alert">
							<strong>{{ $errors->first('conclusion') }}</strong>
						</span>
						@endif
					</div>



					<input type="hidden" name="id_user" value={{Auth::user()->id}}>

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