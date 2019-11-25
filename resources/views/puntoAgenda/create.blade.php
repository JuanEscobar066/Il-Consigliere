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
						<div class="col-md-6">
							<input type="file" id="files" name="files[]" accept="application/pdf" multiple class="form-control" style="height: 45px;" />
						</div>
						<div class="col-md-6">
							<!-- <a id="firmar" class="btn btn-primary mr-2" data-toggle="modal" href="#modal-firma" onclick="smartCardCertificates();">Firmar PDF</a> -->
							<button id="firmar" type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#modal-firma" 
							data-role="disabled" disabled onClick="smartCardCertificates();">Firmar PDF</button>
							<button id="quitar" type="button" class="btn btn-light" disabled>Quitar archivo</button>
						</div>
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
					@include('puntoAgenda.modal')
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

<!-- Los componentes de la Firma Digital. -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('js/FirmaDigital/jquery-3.2.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/FirmaDigital/componente.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/FirmaDigital/modal.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/FirmaDigital/autenticacion.js') }}"></script>

<script>	
	$(document).ready(function() {
		$("#files").change(function() {
			//$("#firmar").prop("disabled", this.files.length == 0);
			if (this.files.length != 0){
				document.getElementById("firmar").disabled = false;				
				document.getElementById("quitar").disabled = false;
			}			
		});	
		
		$('#quitar').click(function(){
			document.getElementById("files").value = "";		
			document.getElementById("firmar").disabled = true;				
			document.getElementById("quitar").disabled = true;	
		});
	});
</script>