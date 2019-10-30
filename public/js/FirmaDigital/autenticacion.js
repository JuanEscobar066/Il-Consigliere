//Funciones de autenticacion en Mer-link
async function inicioSesion(){

    var pin = document.getElementById("pin").value;
    var certificateType = document.querySelector('input[name=tipoCertificado]:checked').value;
    var fileName;
    var slotSelected;

    if(certificateType === "CARD"){
        var selectCerts = document.getElementById("idSelectCerts");
        slotSelected = selectCerts.options[selectCerts.selectedIndex].value;
        if(slotSelected === '-1'){
            alert(selectCerts.options[selectCerts.selectedIndex].text);
            return;
        }
     }else{ //FILE
        var selectFiles = document.getElementById("idSelectFiles");
        fileName = selectFiles.options[selectFiles.selectedIndex].value;
        if(fileName === '-1'){
            alert(selectFiles.options[selectFiles.selectedIndex].text);
            return;
        }
     }

    var jsonParams = {"cmd":"getAuthValues",
                      "password":pin,
                      "signType":TYPE_AUTH,
                      "certificateType":certificateType,
                      "certificatePath":fileName,
                      "validationType":VALIDATION_TYPE,
                      "certificate":CERTIFICATE,
                      "slot":slotSelected};

    var resultado = await service(jsonParams);

    var errorCode = resultado.ErrorCode;
    var description = resultado.Description;

    if(errorCode === 0){
        overlay(); //cerrar modal

        var auth = resultado.Authentication;
        var result = "";
            result += "Fecha Inicio " + auth.validityStart;
            result += "\n\nFecha Expira " + auth.validityExpire;
            result += "\n\nCN " + auth.userCn;
            result += "\n\nDN sin CN " + auth.userDnWithoutCn;
            result += "\n\nLlave de encripcion cookie " + auth.keyEnc;

        document.getElementById("texto").value = result;

    }else{
        //mostrar mensaje de error
        alert(errorCode);
    }
}

async function getCertificadoBase64(){
    var pin = document.getElementById("pin").value;
    var certificateType = document.querySelector('input[name=tipoCertificado]:checked').value;
    var fileName;
    var slotSelected;

    if(certificateType === "CARD"){
        var selectCerts = document.getElementById("idSelectCerts");
        slotSelected = selectCerts.options[selectCerts.selectedIndex].value;
        if(slotSelected === '-1'){
            alert(selectCerts.options[selectCerts.selectedIndex].text);
            return;
        }
     }else{ //FILE
        var selectFiles = document.getElementById("idSelectFiles");
        fileName = selectFiles.options[selectFiles.selectedIndex].value;
        if(fileName === '-1'){
            alert(selectFiles.options[selectFiles.selectedIndex].text);
            return;
        }
     }

     var jsonParams = {"cmd":"certificateBase64",
                      "password":pin,
                      "signType":TYPE_AUTH,
                      "certificateType":certificateType,
                      "certificatePath":fileName,
                      "validationType":VALIDATION_TYPE,
                      "slot":slotSelected};

    var resolve = await service(jsonParams);
    var resultado = JSON.parse(resolve.data);


    var errorCode = resultado.ErrorCode;
    var description = resultado.Description;

    if(errorCode === 0){
        overlay(); //cerrar modal

        var obj = resultado.Certificado;
        document.getElementById("texto").value = obj.certificateBase64;
    }else{
        //mostrar mensaje de error
        alert(description);
    }
}

function generarLlaves(){
    var pin = document.getElementById("pin").value;
    var certificateType = document.querySelector('input[name=tipoCertificado]:checked').value;
    var fileName;
    var slotSelected;
    if(certificateType === "CARD"){
        var selectCerts = document.getElementById("idSelectCerts");
        slotSelected = selectCerts.options[selectCerts.selectedIndex].value;
        if(slotSelected === '-1'){
            alert(selectCerts.options[selectCerts.selectedIndex].text);
            return;
        }
     }else{ //FILE
        var selectFiles = document.getElementById("idSelectFiles");
        fileName = selectFiles.options[selectFiles.selectedIndex].value;
        if(fileName === '-1'){
            alert(selectFiles.options[selectFiles.selectedIndex].text);
            return;
        }
     }
     var jsonParams = {"cmd":"generarLlaves",
                      "password":pin,
                      "signType":TYPE_KEY_GENERATOR,
                      "certificateType":certificateType,
                      "certificatePath":fileName,
                      "validationType":VALIDATION_TYPE,
                      "keyName": "CR_102313231237127381",
                      "slot":slotSelected};
    var resultado = service(jsonParams);
    var errorCode = resultado.ErrorCode;
    var description = resultado.Description;
    if(errorCode === 0){
        overlay(); //cerrar modal
        var obj = resultado.Llaves;
        var llaves = "Llave Publica en base64: \n" + obj.publicKey +"\n\n" + "Llave Privada en base64: \n" + obj.privateKey;
        var divKeys = document.getElementById("keys");
        divKeys.value = llaves;
        //guardar en archivo
        saveFile(llaves, 'userenc.dat', 'text/plain');
    }else{
        //mostrar mensaje de error
        alert(description);
    }
}

function saveFile(text, fileName, type) {
    var link = document.createElement("a");
    var file = new Blob([text], {type: type});
    link.download = fileName;
    link.href = URL.createObjectURL(file);
    document.body.appendChild(link);
    link.click();
      // Cleanup the DOM
    document.body.removeChild(link);
    delete link;

}



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

// Permite leer una cookie del arreglo de las cookies.
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

// Función que permite hacer la firma digital en un archivo PDF.
async function firmarPDF(sesionID){

    // Obtenemos la cookie con el archivo codificado en base 64.
    var b64 = document.getElementById(sesionID.toString()).value;

    // Obtenemos el pin del usuario.
    var pin = document.getElementById("pin").value;

    // El filename que le vamos a pasar a la lectora para que lo firme.
    var fileName;

    // Obtenemos la fecha.
    var d = new Date();
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
    console.log(resultado);

    // Obtenemos el error y la descripción.
    var errorCode   = resultado.ErrorCode;
    var description = resultado.Description;

    // Si no hubo ningún error...
    if(errorCode === 0){

        // Se cierra el modal.
        overlay();

        // Este sería el archivo ya firmado, en base 64.
        var signedFile = resultado.SignedFile.base64File;
        console.log(signedFile);
        document.getElementById(sesionID.toString()).value = signedFile;

        ver(sesionID);

    }else{
        //mostrar mensaje de error
        alert(description);
    }

    function ver(sesionID){

        var base64str = document.getElementById(sesionID.toString()).value;

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


