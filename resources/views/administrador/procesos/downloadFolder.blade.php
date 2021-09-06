<!-- descargar Modal-->
<div class="modal fade" id="downloadFolder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-black">
				<h5 class="modal-title" id="exampleModalLabel">Descargar folder del proceso <span class="badge badge-danger" id="codigo_proceso"></span></h5>
                
				
                    <span class="badge badge-danger" class="close"  data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times fa-lg" style="color:#fff"></i>
                    </span>
			
                
			</div>
			<form  method="POST" action="{{ route('procesos.download.folder') }}" role="form" >
                @csrf
                
				<div class="modal-body">

                        <p>Para poder descargar el folder es necesario colocar tu contraseña</p>
                        
						<input class="form-control {{ $errors->donwloadFolder->has('contraseña') ? ' is-invalid' : '' }}" type="password" name="contraseña" placeholder="Coloca tu contraseña para confirmar">
						@if ($errors->donwloadFolder->has('contraseña'))
							<span class="invalid-feedback" role="alert">
								<strong>{{ $errors->donwloadFolder->first('contraseña') }}</strong>
							</span>
						@endif
						<input type="hidden" name="id" id="downloadFolder_id">
				</div>

				<input type="hidden" name="id_user" value={{Auth::user()->id}}>
			
				<div class="modal-footer">
                        
                        
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-primary">Descargar</button>
				</div>
			</form>
				
		</div>
	</div>
</div>