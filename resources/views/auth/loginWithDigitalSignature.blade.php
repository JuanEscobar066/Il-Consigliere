<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Componente Firma</title>
    <link rel="stylesheet" type="text/css" href="css/modal.css">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/componente.js"></script>
    <script src="js/modal.js"></script>
    <script src="js/autenticacion.js"></script>
</head>
<body>

<div id="overlay" class="modalDialog">
    <div>
        <a onclick="overlay();" title="Cerrar" class="close">X</a>
        <h3>Autenticación</h3>
        <div id="divSmartCard">
            Por favor seleccione el certificado:
            <div id="divSmartCardCerts"></div>
        </div>
        <br><br>
        <label>Pin:</label>
        <input id="pin" type="password" onkeypress="Javascript: if (event.which == 13 || event.keyCode == 13) getDN();"/>
        <button onclick="getDN();">Validar</button>
        <button onclick="overlay();">Cerrar</button>
    </div>
</div>


<center>
    <form id="frm_valores" name="frm_valores">
        Nombre: <input id="out" name="out" value=""> <br>
        Cedula: <input id="cert" name="cert" value=""><br>
        Emision: <input id="emision_dt" name="emision_dt" value=""><br>
        Experacion: <input id="expiracion_dt" name="expiracion_dt" value=""><br>
        Certificado: <input id='cert6' name='cert6' value=''><br>
    </form>
    <button id='check-btn' onClick="showModalAutenticacion(); return false;" class="btn btn-default" value='0'>Verificar</button>
</center>


</body>
</html>
