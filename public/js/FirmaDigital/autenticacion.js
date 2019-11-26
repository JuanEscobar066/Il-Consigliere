// Resuelve la petición del Usuario e imprime la información del Usuario.
async function getDN(){

    // Variables auxiliares.
    var slotSelected;
    var fileName;

    // Se obtienen del HTML del modal.
    var pin         = document.getElementById("pin").value;
    var date        = new Date();
    var selectCerts = document.getElementById("idSelectCerts");
    slotSelected    = selectCerts.options[selectCerts.selectedIndex].value;
    if(slotSelected === '-1'){
        alert(selectCerts.options[selectCerts.selectedIndex].text);
        return;
    }

    // Le pide la fecha a la variable date.
    var token = date.getTime();

    // Se configura todo lo que se necesita del certificado.
    var jsonParams = {"cmd":"getDN",
                      "password":pin,
                      "signType":TYPE_AUTH,
                      "certificateType":"CARD",
                      "certificatePath":fileName,
                      "validationType":VALIDATION_TYPE,
                      "token":token,
                      "slot":slotSelected
                     };

    // Se hace la petición al WebSocket, mediante la función service y se procesan los datos.
    // Importante: de alguna forma, siempre hay que darle tiempo a la variable "resolve", es la que
    // realiza la petición de la firma digital.
    var resolve     = await service(jsonParams);
    var resultado   = JSON.parse(resolve.data);
    var validar     = resultado;

    var errorCode   = resultado.ErrorCode;
    var description = resultado.Description;

    // Verificamos que no haya error.
    if(errorCode === 0){
        overlay();  // Cerrar modal.
        var name;
        var dt_start;
        var dt_expire;
        var auth = resultado.DnInfo;

        // Se setea la información del Usuario.
        name = auth.UserDn;
        // dt_start   = auth.ValidityStart;
        // dt_expire  = auth.ValidityExpire;

        // Se hace un llamado a las otras funciones.
        // Se extrae el nombre del certificado.
        var nombreLimpio = extraerNombre(name);

        // Mediante una cookie (fue la única forma que se nos ocurrió), se guarda
        // para usarlo más adelante.
        document.cookie = "nombreUsuario" + "=" + nombreLimpio;

        // Finalmente, redirija con el nombre del usuario.
        window.location.href = "login/firmaDigital/";

        // extraerCedula(name);
        // FechaExpirValidacion(dt_expire);
        // FechaInicioValidacion(dt_start);
        // extraerCer(auth.CertificateBase64);

    }else{
        //mostrar mensaje de error
        alert(description);
    }
}

// Estas 5 funciones son particularmente útiles para parsear la información del lector y poder utilizarla
// de forma más clara.
// Se le brinda el DN, es decir, la información del Usuario y la parsea para retornarla.
function extraerNombre(DN){

    // Básicamente, lo recorre y lo guarda en la variable nombre.
    var myRe  = /CN=*/g;
    var str   = DN;
    var index = str.indexOf("(");
    var myArray;
    var nombre;
    while ((myArray = myRe.exec(str)) !== null) {
        nombre = str.slice(myRe.lastIndex,index);
    }
    overlay();
    return nombre;
}

function extraerCedula(DN){
    var myRe = /CPF-*/g;
    var str = DN;
    var tam = str.length;
    var myArray;
    var cedula;
    while ((myArray = myRe.exec(str)) !== null) {
        cedula = str.slice(myRe.lastIndex ,tam );
    }
    document.getElementById("cert").value = cedula;
}

function extraerCer(DN){
    document.getElementById("cert6").value = DN;

}

function FechaInicioValidacion(DN){
    var year = DN.slice(0,4);
    var month = DN.slice(5,7);
    var day = DN.slice(8,10);
    var date = ""+day+"-"+month+"-"+year;
    document.getElementById('expiracion_dt').value = date;
}

function FechaExpirValidacion(DN){
    var year2 = DN.slice(0,4);
    var month2 = DN.slice(5,7);
    var day2 = DN.slice(8,10);
    var date2 = ""+day2+"-"+month2+"-"+year2;
    document.getElementById('emision_dt').value = date2;
}

// Función que permite hacer la firma digital en un archivo PDF.
async function firmarPDF(sesionID, tipoDeDocumento){

    // Preguntamos si viene del acta o de la solicitud de puntos y obtenemos el archivo a firmar.
    let tipoArchivo = (tipoDeDocumento === 'puntos') ? 'solicitudPuntos-' : 'actaConsejo-';
    var b64 = document.getElementById(tipoArchivo + sesionID.toString()).value;

    // Obtenemos el pin del usuario.
    let tipoPin = (tipoDeDocumento === "puntos") ? 'pinSolicitudPuntos-' : 'pinActa-';
    const pin = document.getElementById(tipoPin + sesionID.toString()).value;

    // El filename que le vamos a pasar a la lectora para que lo firme.
    var fileName;

    // Obtenemos la fecha.
    var d = new Date();
    var slotSelected;

    // Obtenemos el certificado que el usuario seleccionó.
    var tipoSelect = (tipoDeDocumento === 'puntos') ? 'solicitudPuntos-' : 'acta-';
    var selectCerts = document.getElementById("idSelectCerts-" + tipoSelect + sesionID.toString());

    slotSelected = selectCerts.options[selectCerts.selectedIndex].value;
    if(slotSelected === '-1'){
       alert(selectCerts.options[selectCerts.selectedIndex].text);
       return;
    }

    // Se le indica que el país de origen es Costa Rica.
    var reason = "Razon";
    var country = "CR";

    // Se crea el JSON con toda la información necesaria para firmar.
    var jsonParams = {"cmd":"signPDFFile",
                      "password":pin,
                      "signType":TYPE_SIGN,
                      "certificateType":"CARD",
                      "certificatePath":fileName,
                      "validationType":VALIDATION_TYPE,
                      "fileBase64":b64,
                      "reason":reason,
                      "country":country,
                      "fileName":"pdf_firmado.pdf",
                      "slot":slotSelected};

    // Se hace la resolución del servicio.
    var resolve = await service(jsonParams);

    // Se parsea la información recibida.
    var resultado = JSON.parse(resolve.data);

    // Obtenemos el error y la descripción.
    var errorCode   = resultado.ErrorCode;
    var description = resultado.Description;

    // Si no hubo ningún error...
    if(errorCode === 0){

        // Se cierra el modal.
        overlay(sesionID, tipoDeDocumento);

        // Este sería el archivo ya firmado, en base 64.
        var signedFile = resultado.SignedFile.base64File;
        document.getElementById(tipoArchivo + sesionID.toString()).value = signedFile;

        ver(sesionID, tipoDeDocumento);

    }else{
        //mostrar mensaje de error
        alert(description);
    }

    // Permite ver PDFs en nuevas pestañas.
    function ver(sesionID, tipoDeDocumento){

        // Se obtiene el archivo del HTML.
        var tipoDocumento   = (tipoDeDocumento === 'puntos') ? 'solicitudPuntos-' : 'actaConsejo-';
        var base64str       = document.getElementById(tipoDocumento + sesionID.toString()).value;

        // Decode base64 string, remove space for IE compatibility.
        var binary  = atob(base64str.replace(/\s/g, ''));
        var len     = binary.length;
        var buffer  = new ArrayBuffer(len);
        var view    = new Uint8Array(buffer);
        for (var i = 0; i < len; i++) {
            view[i] = binary.charCodeAt(i);
        }

        // Create the blob object with content-type "application/pdf".
        var blob    = new Blob( [view], { type: "application/pdf" });
        var url     = URL.createObjectURL(blob);

        window.open(url);
    }

}

// Función que permite hacer la firma digital pero en archivos adjuntos.
async function firmarPDFAdjunto() {

    // Obtenemos el archivo firmado.
    var b64 = document.getElementById("base64").value;

    // Obtenemos el pin del usuario.
    var pin = document.getElementById("pin").value;

    // El filename que le vamos a pasar a la lectora para que lo firme.
    var fileName;
    var slotSelected;

    // Obtenemos el certificado que el usuario seleccionó.
    var selectCerts = document.getElementById("idSelectCerts");
    slotSelected = selectCerts.options[selectCerts.selectedIndex].value;
    if(slotSelected === '-1'){
        alert(selectCerts.options[selectCerts.selectedIndex].text);
        return;
    }

    // Se le indica que el país de origen es Costa Rica.
    var reason = "Razon";
    var country = "CR";

    // Se crea el JSON con toda la información necesaria para firmar.
    var jsonParams = {"cmd":"signPDFFile",
        "password":pin,
        "signType":TYPE_SIGN,
        "certificateType":"CARD",
        "certificatePath":fileName,
        "validationType":VALIDATION_TYPE,
        "fileBase64":b64,
        "reason":reason,
        "country":country,
        "fileName":"pdf_firmado.pdf",
        "slot":slotSelected};

    // Se hace la resolución del servicio.
    var resolve = await service(jsonParams);

    // Se parsea la información recibida.
    var resultado = JSON.parse(resolve.data);

    // Obtenemos el error y la descripción.
    var errorCode   = resultado.ErrorCode;
    var description = resultado.Description;

    // Si no hubo ningún error...
    if(errorCode === 0){

        // Este sería el archivo ya firmado, en base 64.
        var signedFile = resultado.SignedFile.base64File;
        document.getElementById("base64").value = signedFile;

        // Abre una nueva pestaña con el archivo.
        ver();

    }else{
        //mostrar mensaje de error
        alert(description);
    }

    // Permite agarrar un archivo en base 64 y lo convierte en PDF.
    function ver(){

        // Busca el puente.
        var base64str = document.getElementById("base64").value;

        // decode base64 string, remove space for IE compatibility
        var binary = atob(base64str.replace(/\s/g, ''));
        var len = binary.length;
        var buffer = new ArrayBuffer(len);
        var view = new Uint8Array(buffer);
        for (var i = 0; i < len; i++) {
            view[i] = binary.charCodeAt(i);
        }

        // create the blob object with content-type "application/pdf"
        var blob = new Blob( [view], { type: "application/pdf" });
        var url = URL.createObjectURL(blob);

        window.open(url);
    }

}

// Convierte el PDF a base 64.
function convertToBase64() {

    //Read File
    var selectedFile = document.getElementById("files").files;

    //Check File is not Empty
    if (selectedFile.length > 0) {

        // Select the very first file from list
        var fileToLoad = selectedFile[0];

        // FileReader function for read the file.
        var fileReader = new FileReader();
        var base64;

        // Onload of file read the file content
        fileReader.onload = function(fileLoadedEvent) {
            base64 = fileLoadedEvent.target.result;
            // Print data in console

            document.getElementById("base64").value = base64.slice(28, base64.length);
        };
        // Convert data to base64
        fileReader.readAsDataURL(fileToLoad);
    }
}

