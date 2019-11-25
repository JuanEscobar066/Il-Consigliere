// Es la función que permite "obtener" focus del Usuario para pedirle el PIN.
function overlay(idModal, tipoDeDocumento) {
    var tipoEl  = (tipoDeDocumento === "puntos") ? "solicitudPuntos-" : "acta-";
    var el      = document.getElementById("overlay-" + tipoEl + idModal);

    // Es un if-else.
    el.style.visibility = (el.style.visibility === "visible") ? "hidden" : "visible";

    // Se obtiene el tipo de pin.
    var tipoPin = (tipoDeDocumento === "puntos") ? "SolicitudPuntos-" : "Acta-";
    var pin     = document.getElementById("pin" + tipoPin + idModal);
    pin.value   = "";
    pin.focus();
}

// Carga los certificados de la firma de la persona.
async function smartCardCertificates(idModal, tipoDeDocumento){

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
        var tipoCerts   = (tipoDeDocumento === 'puntos') ? 'solicitudPuntos-' : 'acta-';
        let itGo        = 'divSmartCardCerts-' + tipoCerts + idModal;

        // Busca el modal con ese id.
        var divCerts = document.getElementById(itGo);

        // Obtiene los certificados.
        var objCerts = resultado.Certificados;

        // Busca el HTML con ese id.
        var tipoCert    = (tipoDeDocumento === 'puntos') ? 'solicitudPuntos-' : 'acta-';
        let itRip       = 'idSelectCerts-' + tipoCert + idModal;
        var htmlCerts   = "<select id=" + itRip + ">";

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
