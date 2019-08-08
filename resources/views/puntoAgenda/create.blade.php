@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
              <h4 class="card-title">Nuevo punto de agenda</h4>
              <p class="card-description">
                Solicitud de un nuevo punto
              </p>
		<form method="post" action="{{route('puntoAgenda.store')}}" enctype="multipart/form-data">
			@csrf
			<div class="form-group row">
			<label for="titulo" class="col-sm-3 col-form-label">Título</label>
			  <div class="col-sm-9">
			    <input type="text" name="titulo_punto" class="form-control" placeholder="titulo" parsley-trigger="change">
			  </div>
			</div>
			<div class="form-group row">
			  <label for="considerando" class="col-sm-6 col-form-label">Considerando</label>
			      <textarea class="form-control" name="considerando_punto" rows="10"></textarea>
			</div>                
			<div class="form-group row">
			  <label for="acuerda" class="col-sm-6 col-form-label">Se acuerda</label>
			      <textarea class="form-control" name="se_acuerda_punto" rows="6"></textarea>
			</div>                
			<div class="form-group row">
				<input type="file" id="files" name="files[]" multiple class="form-control"/>
			</div>
			<div class="form-group row">
				<label class="col-sm-12 col-form-label labels">Agenda</label>
				<select name="agenda" class="form-control">
					@foreach($agendas as $agenda)
						<option value="{{$agenda->id}}">Agenda del día {{$agenda->fecha}} {{$agenda->hora}}</option>
					@endforeach
				</select>
			</div>                
			
			<button type="submit" class="btn btn-primary mr-2">Solicitar</button>
			<button type="button" class="btn btn-light" onClick="document.location.href='/puntoAgenda'">Cancelar</button>
		</form>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
</script>
