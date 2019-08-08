<div class="modal fade modal-slide-in-right" id="modal-delete-punto-{{$p->id_punto}}" aria-hidden="true" role="dialog">

  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmar acción</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	<form method="post" action="{{route('puntoAgenda.destroy',$p->id_punto)}}">
	@csrf
	@method('DELETE')
		<p>¿Realmente desea eliminar el punto propuesto?</p>
      </div>
      <div class="modal-footer">
	<button type="submit" class="btn btn-primary mr-2">Confirmar</button>
	<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
      </div>
	</form>
    </div>
  </div>
</div>

