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
    
function extraerNombre(DN){
	 var myRe  = /CN=*/g;
	 var str   = DN;
	 var tam   = str.length;
	 var index = str.indexOf("(");
	 var myArray;
	 var nombre;
	 while ((myArray = myRe.exec(str)) !== null) {
	  nombre = str.slice(myRe.lastIndex,index);
	  
	 }
	 //alert("El nombre extraido es : " + nombre );
     document.getElementById('out').value = nombre;
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

async function getDN(){
    var pin = document.getElementById("pin").value;
    var fileName;
    var d = new Date();
    var token = d.getTime();
    var slotSelected;
    var opcion = 1;
   var selectCerts = document.getElementById("idSelectCerts");
   slotSelected = selectCerts.options[selectCerts.selectedIndex].value;
   if(slotSelected === '-1'){
       alert(selectCerts.options[selectCerts.selectedIndex].text);
       return;
   }

    var jsonParams = {"cmd":"getDN", 
                      "password":pin,
                      "signType":TYPE_AUTH,
                      "certificateType":"CARD",
                      "certificatePath":fileName,
                      "validationType":VALIDATION_TYPE,
                      "token":token,
                      "slot":slotSelected
                     };
                     
    var resolve = await service(jsonParams);
    var resultado = JSON.parse(resolve.data);
    
    var errorCode = resultado.ErrorCode;
    var description = resultado.Description;

    if(errorCode === 0){
        overlay(); //cerrar modal
        var auth = resultado.DnInfo;
        var name = "";
        var dt_start="";
        var dt_expire="";

        name       = auth.UserDn;
        dt_start   = auth.ValidityStart;
        dt_expire  = auth.ValidityExpire;

        extraerNombre(name);
        extraerCedula(name);
        FechaExpirValidacion(dt_expire);
        FechaInicioValidacion(dt_start);
        extraerCer(auth.CertificateBase64);



    }else{
        //mostrar mensaje de error
        alert(description);
    }
    
    
} 




async function firmarPDF(){
    
    var b64;
    b64 = document.getElementById("base64").value;
    
    var pin = document.getElementById("pin").value;
    var fileName;
    
    var d = new Date();
    var token = d.getTime();
    var slotSelected;
    var opcion = 1;
   var selectCerts = document.getElementById("idSelectCerts");
   slotSelected = selectCerts.options[selectCerts.selectedIndex].value;
   if(slotSelected === '-1'){
       alert(selectCerts.options[selectCerts.selectedIndex].text);
       return;
   }

    
    
    
    var reason = "Razon";
    var country = "CR";
    
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
                  
    var resolve = await service(jsonParams);
    var resultado = JSON.parse(resolve.data);
    var errorCode = resultado.ErrorCode;
    var description = resultado.Description;

    if(errorCode === 0){
        overlay(); //cerrar modal
      
         var signedFile = resultado.SignedFile;
        //console.log(signedFile.base64File);
         
        document.getElementById("base64_firmado").value = signedFile.base64File;
        
    }else{
        //mostrar mensaje de error
        alert(description);
    }
    
    
} 


