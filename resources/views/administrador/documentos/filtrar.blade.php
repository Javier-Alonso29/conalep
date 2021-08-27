<!--Modal Eliminar-->
<div class="modal fade" id="filtrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-black">
				<h5 class="modal-title" id="exampleModalLabel">¿Seguro que quieres aplicar este filtro?</h5>
                    <span class="badge badge-danger" class="close"  data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times fa-lg" style="color:#fff"></i>
                    </span>
			</div>
			
			<form  method="GET" action="{{ route('documentos.filtrar') }}" role="form" >


				<input type="hidden" id="filtrar_id" name="filtrar_id" value="{{ old('filtrar_id') }}" required>


				<div class="modal-footer">
						<button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-success">Aplicar</button>
				</div>
			</form>
				
		</div>
	</div>
</div>