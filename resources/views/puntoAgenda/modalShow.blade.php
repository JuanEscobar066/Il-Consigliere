<div class="modal fade modal-slide-in-right" id="modal-show-punto-{{$p->id_punto}}" aria-hidden="true" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{$p->titulo}}</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	<form method="post" action ="{{route('puntoAgenda.update',$p->id_punto)}}" enctype="multipart/form-data">
		@csrf
		@method('PATCH')
		<div class="form-group row">
		<label for="titulo" class="col-sm-3 col-form-label">Título</label>
		  <div class="col-sm-9">
		    <input type="text" name="titulo_punto" class="form-control" value="{{$p->titulo}}" parsley-trigger="change">
		  </div>
		</div>
		<div class="form-group row">
		  <label for="considerando" class="col-sm-6 col-form-label">Considerando</label>
		<textarea class="form-control" name="considerando_punto" rows="10">{{$p->considerando}}</textarea>
		</div>                
		<div class="form-group row">
		  <label for="acuerda" class="col-sm-6 col-form-label">Se acuerda</label>
	    	  <textarea class="form-control" name="se_acuerda_punto" rows="10">{{$p->acuerda}}</textarea>
		</div>                
		<div class="form-group row">
			<ul>
			@foreach($p->adjuntos as $a)
				<li><a href="{{ route('downloadFile', $a->ruta) }}">{{$a->nombre}}</a></li>
			@endforeach
			</ul>
		</div>                
		<div class="form-group row">
			<input type="file" id="files" name="files[]" multiple class="form-control"/>
		</div>                

      </div>
      <div class="modal-footer">
	<button type="submit" class="btn btn-primary mr-2">Actualizar</button>
	<button class="btn btn-light" data-dismiss="modal">Cerrar</button>
      </div>
	</form>
    </div>
  </div>
</div>
