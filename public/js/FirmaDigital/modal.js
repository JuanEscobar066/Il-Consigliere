// Es la función que permite "obtener" focus del Usuario para pedirle el PIN.
function overlay() {
    var el = document.getElementById("overlay");

    // Es un if-else.
    el.style.visibility = (el.style.visibility === "visible") ? "hidden" : "visible";
    var pin = document.getElementById("pin");
    pin.value = "";
    pin.focus();
}

// Esta función permite mostrar un filtro de la verficación de conexión.
async function showModalAutenticacion(){

  // Variable que funciona como un filtro.
  // Hace referencia al modal del modal.css.
  var modalLoading = jq('#divLoading');
  console.log("logre llegar al showModalautenticacion");
  await verificarConexion(modalLoading);
    smartCardCertificates();
}

// Verifica que haya conexión con el componente.
function verificarConexion(modalLoading){
	var result = "";
	var jsonParams = {"cmd":"info"};
	var codigo = 2;

  // Crea de nuevo un web service para
	var ws = new WebSocket(URL_SERVICE);
	return new Promise(function(resolve, reject){
		ws.onopen = function() {
		    modalLoading.show();

        // El envía los datos del jsonParams para ir al web socket.
		    ws.send(JSON.stringify(jsonParams));
		};
		ws.onmessage = function (evt) {
		    result = JSON.parse(evt.data);
		    if(result.ErrorCode === 0){
	            var version = parseFloat(result.Version);
	            codigo = 0;
	            modalLoading.hide();
	            varificarResultado(codigo);
	        }
		    resolve();
		};
		ws.onerror = function(err) {
			codigo = 2;
			modalLoading.hide();
		    varificarResultado(codigo);
		    reject();
		};
	});
}

function varificarResultado(codigo){
    if(codigo === 0){
        overlay();
        smartCardCertificates();
    }else{
        if(codigo === 1){
            alert("Su equipo dispone de una versión desactualizada del componente de firma digital.");
        }else {
            alert("Error de conexión con el componente de firma digital.\n\Favor verifique que tenga instalado el componente de firma digital.");
        }
        var cfm = confirm("Desea descargar el instalador del componente de firma digital?");
        if (cfm === true) {
            //Descargar el instalador del componente
            alert("Hacer boton para descargar el controlador");
        }
    }
}

// Carga los certificados de la firma de la persona.
async function smartCardCertificates(idModal){

    // Configuración de la tarjeta.
    var jsonParams = {"cmd":"smartCardCertificates"};

    // Llama al componente para obtener los resultados.
    var resolve     = await service(jsonParams);
    var resultado   = JSON.parse(resolve.data);

    // Parsea la información del componente.
    var errorCode   = resultado.ErrorCode;
    var description = resultado.Description;

    // Si no hubo errores.
    if(errorCode === 0){

        // Calcula el id del modal.
        let itGo = 'divSmartCardCerts-' + idModal;

        // Busca el modal con ese id.
        var divCerts = document.getElementById(itGo);

        // Obtiene los certificados.
        var objCerts = resultado.Certificados;

        // Busca el HTML con ese id.
        let itRip       = 'idSelectCerts-' + idModal;
        var htmlCerts   = "<select id=itRip>";

        // Finalmente, carga todas las opciones con los certificados.
        if(objCerts.length >= 1){
            if(objCerts.length > 1){
                htmlCerts += "<option value='-1' disabled selected hidden>Seleccione su certificado </option>";
           }
           for (var i = 0; i < objCerts.length; i++) {
               htmlCerts += "<option value='"+objCerts[i].slot+"'>"+objCerts[i].titularCertificado+"</option>";
           }
        }else{
            htmlCerts += "<option value='-1' disabled selected hidden>No se han detectado tarjetas conectadas</option>";
       }
       htmlCerts += "</select>";
       divCerts.innerHTML = htmlCerts;
    }else{
        alert(description);
    }
}
