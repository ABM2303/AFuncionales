<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Include common resources -->
    <?php include 'commonResources.php'; ?>
    <title>Response</title>
    <!-- Styles -->
    <link rel="stylesheet" href="Styles/ventanaResponseStyles.css">
</head>

<body>
    <div id="ResponseDocCont">
        <!-- Ventana de respuesta con objeto normal -->
        <div id="ResponseDoc">
            <div class="ResponseTitle">
                <h2 style="color: var(--Background);">Registro generado exitosamente</h2>
                <button id="ResponseDocClose" class="ResponseDocCloseCustom" onclick="CloseResponse()">
                    <i class="bi bi-x-circle"></i>
                </button>
            </div>
            <object class="ResponseObject" data="" download=""></object>
        </div>
        <!-- Ventana de información -->
        <div id="WaitDoc">
            <div class="ResponseTitle">
                <h2 style="color: var(--Background);">Generando registro...</h2>
                <button id="ResponseDocClose" class="WaitResponseDocClose" onclick="CloseResponse()">
                    <i class="bi bi-x-circle"></i>
                </button>
            </div>
            <h3 class="WaitDocText">Por favor espere un momento</h3>
        </div>
        <!-- Ventana de subida de documentos -->
        <div id="UploadDoc">
            <div class="ResponseTitle">
                <h2 style="color: var(--Background);">Sube tus documentos</h2>
                <button id="ResponseDocClose" onclick="CloseResponse()">
                    <i class="bi bi-x-circle"></i>
                </button>
            </div>
            <label class="inputFileLabel" for="SubirDocs">
                <span class="inputFileSpan">
                    Suelta tus archivos aquí<br>
                    O<br>
                </span>
                <input class="inputFile" type="file" name="SubirDocs" id="SubirDocs" accept=".pdf">
            </label>
            <input type="text" id="folio" value="" hidden>
            <button class="ResponseDocUploadButton" type="submit" onclick="subirDocumentos()">
                <i class="bi bi-cloud-upload"></i>
                <span>Subir</span>
            </button>
        </div>
        <!-- Ventana de respuesta con objeto editable -->
        <div id="ResponseDocEditable">
            <div class="ResponseTitle">
                <h2 style="color: var(--Background);">Documentos subidos</h2>
                
                <button id="ResponseDocClose" class="ResponseDocCloseCustom" onclick="CloseResponse()">
                    <i class="bi bi-x-circle"></i>
                </button>
            </div>
            <object class="ResponseObject" data="" download=""></object>
            <p>* En caso de que el documento no se vea actualizado, intente eliminar el historial del navegador.</p>
            <button class="ResponseDocReplaceButton" onclick="">
                <i class="bi bi-cloud-upload"></i>
                <span>Reemplazar</span>
            </button>
        </div>


        <!-- Ventana de respuesta con campo para nota de cancelacion -->
        <div id="ResponseCancel">
            <div class="ResponseTitle">
                <h2 style="color: var(--Background);">Cancelar registro</h2>
                <button id="ResponseDocClose" class="CancelResponseDocClose" onclick="CloseResponse()">
                    <i class="bi bi-x-circle"></i>
                </button>
            </div>
            <h3 id="ResponseCancelQuestion">¿Estás seguro de que deseas cancelar este registro?</h3>
            <h4 id="ResponseCancelWarning">⚠️ Una vez cancelado, no se podrá reactivar ⚠️</h4>
            <textarea id="ResponseCancelTextarea" class="ResponseCancelNote" placeholder="Escribe una nota de cancelación (max. 500 carácteres)" maxlength="500"></textarea>
            <button class="ResponseCancelButton" onclick="">
                <i class="bi bi-x-octagon"></i>
                <span>Cancelar registro</span>
            </button>
            <button class="ResponseVerifyButton" onclick="">
                <i class="bi bi-check-circle"></i>
                <span>Verificar registro</span>
            </button>
        </div>


        <!-- Eliminar un registro -->
        <div id="ResponseDelete">
            <div class="ResponseTitle">
                <h2 style="color: var(--Background);">Eliminar registro</h2>
                <button id="ResponseDocClose" class="DeleteResponseDocClose" onclick="CloseResponse()">
                    <i class="bi bi-x-circle"></i>
                </button>
            </div>
            <h3 id="ResponseDeleteQuestion">¿Estás seguro de que deseas eliminar este registro?</h3>
            <h4 id="ResponseDeleteWarning">⚠️ Una vez eliminado, no se podrá recuperar ⚠️</h4>
            <button class="ResponseDeleteButton" onclick="">
                <i class="bi bi-x-octagon"></i>
                <span>Eliminar registro</span>
            </button>
        </div>

        <!-- Eliminar un registro -->
        <div id="ResponseDeleteA">
            <div class="ResponseTitle">
                <h2 style="color: var(--Background);">Eliminar registro</h2>
                <button id="ResponseDocClose" class="DeleteResponseDocClose" onclick="CloseResponse()">
                    <i class="bi bi-x-circle"></i>
                </button>
            </div>
            <h3 id="ResponseDeleteAQuestion">¿Estás seguro de que deseas eliminar este registro?</h3>
            <h4 id="ResponseDeleteAWarning">⚠️ Una vez eliminado, no se podrá recuperar ⚠️</h4>
            <button class="ResponseDeleteAButton" onclick="">
                <i class="bi bi-x-octagon"></i>
                <span>Eliminar registro</span>
            </button>
        </div>

        <!-- Validar un registro -->
        <div id="ResponseValidar">
            <div class="ResponseTitle">
                <h2 style="color: var(--Background);">Validar registro</h2>
                <button id="ResponseDocClose" class="ValidarResponseDocClose" onclick="CloseResponse()">
                    <i class="bi bi-x-circle"></i>
                </button>
            </div>
            <h3 id="ResponseValidarQuestion">¿Estás seguro de que deseas validar este registro?</h3>
            <h4 id="ResponseValidarWarning">⚠️ Una vez validado, no se podran hacer cambios ⚠️</h4>
            <button class="ResponseValidarButton" onclick="">
                <i class="bi bi-x-octagon"></i>
                <span>Validar registro</span>
            </button>
        </div>

        <!-- Validar un registro -->
        <div id="ResponseValidarA">
            <div class="ResponseTitle">
                <h2 style="color: var(--Background);">Validar registro</h2>
                <button id="ResponseDocClose" class="ValidarResponseDocClose" onclick="CloseResponse()">
                    <i class="bi bi-x-circle"></i>
                </button>
            </div>
            <h3 id="ResponseValidarAQuestion">¿Estás seguro de que deseas validar este registro?</h3>
            <h4 id="ResponseValidarAWarning">⚠️ Una vez validado, no se podran hacer cambios ⚠️</h4>
            <button class="ResponseValidarAButton" onclick="">
                <i class="bi bi-x-octagon"></i>
                <span>Validar registro</span>
            </button>
        </div>

        <div id="ResponseError">
            <div class="ResponseTitle">
                <h2 style="color: var(--Background);">Comentar error</h2>
                <button id="ResponseDocClose" class="ErrorResponseDocClose" onclick="CloseResponse()">
                    <i class="bi bi-x-circle"></i>
                </button>
            </div>
            <h3 id="ResponseErrorQuestion">¿Existe algun problema con el registro?</h3>
            <textarea id="ResponseErrorTextarea" class="ResponseErrorNote" placeholder="Escribe un comentario sobre porque el registro esta mal. (max. 500 carácteres)" maxlength="500"></textarea>
            <button class="ResponseErrorButton" onclick="">
                <i class="bi bi-x-octagon"></i>
                <span>Enviar comentario.</span>
            </button>
        </div>

        <div id="ResponseFull">
            <div class="ResponseTitle">
                <h2 style="color: var(--Background);">Comentar error</h2>
                <button id="ResponseDocClose" class="ErrorResponseDocClose" onclick="CloseResponse()">
                    <i class="bi bi-x-circle"></i>
                </button>
            </div>
            
            <h3 id="ResponseFullQuestion">¿Existe algun problema con el registro?</h3>
            <textarea id="ResponseFullTextarea" class="ResponseFullNote" placeholder="Escribe un comentario sobre porque el registro esta mal. (max. 500 carácteres)" maxlength="500"></textarea>
            <button class="ResponseFullButton" onclick="">
                <i class="bi bi-x-octagon"></i>
                <span>Enviar comentario.</span>
            </button>
        </div>


        <!-- Modificar registros de entradas -->
        <div id="ResponseModify">
            <div class="ResponseTitle">
                <h2 style="color: var(--Background);">Modificar registro</h2>
                <button id="ResponseDocClose" class="ResponseModifyClose" onclick="">
                    <i class="bi bi-x-circle"></i>
                </button>
            </div>
            <div id="ContFormModify">

            </div>
        </div>
    </div>
</body>

</html>
<script>
    function CloseResponse() {
        data = null;
        blob = null;
        $('#ResponseDocCont').css('display', 'none');
        $('#ResponseDoc').css('display', 'none');
        $('#WaitDoc').css('display', 'none');
        $('#UploadDoc').css('display', 'none');
        $('#ResponseDocEditable').css('display', 'none');
        $('#ResponseCancel').css('display', 'none');
        $('#ResponseDelete').css('display', 'none');
        $('#ResponseDeleteA').css('display', 'none');
        $('#ResponseValidar').css('display', 'none');
        $('#ResponseValidarA').css('display', 'none');
        $('#ResponseError').css('display', 'none');
        $('#ResponseFull').css('display', 'none');
        $('#ResponseModify').css('display', 'none');
    }

    function WaitDoc(title, message, closeFunction) {
    CloseResponse();
    $('#ResponseDocCont').css('display', 'flex');
    $('#WaitDoc').css('display', 'flex');
    $('.ResponseTitle h2').text(title);
    $('#WaitDoc .WaitDocText').text(message);
    
    if (closeFunction === "CloseResponse()" || closeFunction === "location.reload()") {
        $('.WaitResponseDocClose').attr('onclick', closeFunction);
    } else if (closeFunction === "redirect_to_index") {
        // Si closeFunction es "redirect_to_index", redirigir al index
        $('.WaitResponseDocClose').off('click').on('click', function() {
            window.location.href = 'index.php'; // Cambia 'index.php' al archivo al que quieras redirigir
        });
    } else if (closeFunction === "redirect_to_listm") {
        // Si closeFunction es "redirect_to_index", redirigir al index
        $('.WaitResponseDocClose').off('click').on('click', function() {
            window.location.href = 'RevisarBeneficiarios.php'; // Cambia 'index.php' al archivo al que quieras redirigir
        });
    } else if (closeFunction === "redirect_to_lists") {
        // Si closeFunction es "redirect_to_index", redirigir al index
        $('.WaitResponseDocClose').off('click').on('click', function() {
            window.location.href = 'UsuariosConBeneficiarios.php'; // Cambia 'index.php' al archivo al que quieras redirigir
        });
    } else if (closeFunction === "redirect_to_listsa") {
        // Si closeFunction es "redirect_to_index", redirigir al index
        $('.WaitResponseDocClose').off('click').on('click', function() {
            window.location.href = 'ListaApoyados.php'; // Cambia 'index.php' al archivo al que quieras redirigir
        });
    } else {
        $('.WaitResponseDocClose').off('click').on('click', closeFunction);
    }
}


    function ResponseDoc(title, objectData, downloadName, closeFunction) {
        CloseResponse();
        event.preventDefault();
        $('#ResponseDocCont').css('display', 'flex');
        $('#ResponseDoc').css('display', 'flex');
        $('.ResponseTitle h2').text(title);
        $('.ResponseObject').attr('data', objectData);
        $('.ResponseObject').attr('download', downloadName);
        $('#ResponseObjectFail').attr('href', objectData);
        $('#ResponseObjectFail').attr('download', downloadName);
        $('#ResponseDocClose').attr('onclick', closeFunction);
    }

    function UploadDoc(title, folio, accion) {
        CloseResponse();
        event.preventDefault();
        $('#ResponseDocCont').css('display', 'flex');
        $('#UploadDoc').css('display', 'flex');
        $('.ResponseTitle h2').text(title);
        $('#folio').val(folio);
        if (accion == "Estudios") { 
            $('.ResponseDocUploadButton').attr('onclick', 'subirDocumentos("IMGFUNCIONALES2024/Estudios/", "' + folio + '.pdf", "Estudios")');
        } else if (accion == "INE") {
            $('.ResponseDocUploadButton').attr('onclick', 'subirDocumentos("IMGFUNCIONALES2024/INE/", "' + folio + '.pdf", "INE")');
        } else if (accion == "IDBeneficiario") {
            $('.ResponseDocUploadButton').attr('onclick', 'subirDocumentos("IMGFUNCIONALES2024/IdBeneficiario/", "' + folio + '.pdf", "IDBeneficiario")');
        }else if(accion == "CURP"){
            $('.ResponseDocUploadButton').attr('onclick', 'subirDocumentos("IMGFUNCIONALES2024/CURP/", "' + folio + '.pdf", "CURP")');
        }else if(accion == "Domicilio"){
            $('.ResponseDocUploadButton').attr('onclick', 'subirDocumentos("IMGFUNCIONALES2024/Domicilio/", "' + folio + '.pdf", "Domicilio")');
        }else if(accion == "Indicacion"){
            $('.ResponseDocUploadButton').attr('onclick', 'subirDocumentos("IMGFUNCIONALES2024/Indicacion/", "' + folio + '.pdf", "Indicacion")');
        }else if(accion == "Solicitud"){
            $('.ResponseDocUploadButton').attr('onclick', 'subirDocumentos("IMGFUNCIONALES2024/Solicitud/", "' + folio + '.pdf", "Solicitud")');
        }else if(accion == "Foto"){
            $('.ResponseDocUploadButton').attr('onclick', 'subirDocumentos("IMGFUNCIONALES2024/Foto/", "' + folio + '.pdf", "Foto")');
        }else if(accion == "FotoE"){
            $('.ResponseDocUploadButton').attr('onclick', 'subirDocumentos("IMGFUNCIONALES2024/FotoEntrega/", "' + folio + '.pdf", "FotoE")');
        }else if(accion == "Recibo"){
            $('.ResponseDocUploadButton').attr('onclick', 'subirDocumentos("IMGFUNCIONALES2024/Recibo/", "' + folio + '.pdf", "Recibo")');
        }
        //Apoyo Directo
        else if (accion == "AEstudios") { 
            $('.ResponseDocUploadButton').attr('onclick', 'subirDocumentos("IMGAPOYOS2024/Estudios/", "' + folio + '.pdf", "AEstudios")');
        } else if (accion == "AINE") {
            $('.ResponseDocUploadButton').attr('onclick', 'subirDocumentos("IMGAPOYOS2024/INE/", "' + folio + '.pdf", "AINE")');
        } else if (accion == "AIDBeneficiario") {
            $('.ResponseDocUploadButton').attr('onclick', 'subirDocumentos("IMGAPOYOS2024/IdBeneficiario/", "' + folio + '.pdf", "AIDBeneficiario")');
        }else if(accion == "ACURP"){
            $('.ResponseDocUploadButton').attr('onclick', 'subirDocumentos("IMGAPOYOS2024/CURP/", "' + folio + '.pdf", "ACURP")');
        }else if(accion == "ADomicilio"){
            $('.ResponseDocUploadButton').attr('onclick', 'subirDocumentos("IMGAPOYOS2024/Domicilio/", "' + folio + '.pdf", "ADomicilio")');
        }else if(accion == "AIndicacion"){
            $('.ResponseDocUploadButton').attr('onclick', 'subirDocumentos("IMGAPOYOS2024/Indicacion/", "' + folio + '.pdf", "AIndicacion")');
        }else if(accion == "ASolicitud"){
            $('.ResponseDocUploadButton').attr('onclick', 'subirDocumentos("IMGAPOYOS2024/Solicitud/", "' + folio + '.pdf", "ASolicitud")');
        }else if(accion == "AFoto"){
            $('.ResponseDocUploadButton').attr('onclick', 'subirDocumentos("IMGAPOYOS2024/Foto/", "' + folio + '.pdf", "AFoto")');
        }else if(accion == "AFotoE"){
            $('.ResponseDocUploadButton').attr('onclick', 'subirDocumentos("IMGAPOYOS2024/FotoEntrega/", "' + folio + '.pdf", "AFotoE")');
        }else if(accion == "ARecibo"){
            $('.ResponseDocUploadButton').attr('onclick', 'subirDocumentos("IMGAPOYOS2024/Recibo/", "' + folio + '.pdf", "ARecibo")');
        }else if(accion == "Factura"){
            $('.ResponseDocUploadButton').attr('onclick', 'subirDocumentos("IMGAPOYOS2024/Factura/", "' + folio + '.pdf", "Factura")');
        }
    }

    function ResponseDocEditable(title,objectData, closeFunction, replaceFunction) {
        CloseResponse();
        event.preventDefault();
        $('#ResponseDocCont').css('display', 'flex');
        $('#ResponseDocEditable').css('display', 'flex');
        $('.ResponseTitle h2').text(title);
        $('.ResponseObject').attr('data', objectData);
        $('#ResponseDocEditable .ResponseDocCloseCustom').attr('onclick', closeFunction);
        $('#ResponseDocEditable .ResponseDocReplaceButton').attr('onclick', replaceFunction);
    }

    function ResponseDelete(id){
        CloseResponse();
        event.preventDefault(); 
        $('#ResponseDocCont').css('display', 'flex');
        $('#ResponseDelete').css('display', 'flex');
        $('#ResponseDelete .ResponseDeleteButton').off('click').on('click', function() {eliminarRegistro(id);});
       
    }

    function ResponseDeleteA(id){
        CloseResponse();
        event.preventDefault(); 
        $('#ResponseDocCont').css('display', 'flex');
        $('#ResponseDeleteA').css('display', 'flex');
        $('#ResponseDeleteA .ResponseDeleteAButton').off('click').on('click', function() {eliminarRegistroA(id);});
       
    }

    function ResponseValidar(id, supervisor){
        CloseResponse();
        $('#ResponseDocCont').css('display', 'flex');
        $('#ResponseValidar').css('display', 'flex');
        $('#ResponseValidar .ResponseValidarButton').off('click').on('click', function() {validarRegistro(id, supervisor);});
       
    }

    function ResponseValidarA(id, supervisor){
        CloseResponse();
        $('#ResponseDocCont').css('display', 'flex');
        $('#ResponseValidarA').css('display', 'flex');
        $('#ResponseValidarA .ResponseValidarAButton').off('click').on('click', function() {validarRegistroA(id, supervisor);});
       
    }

    function ResponseCancel(title, accion, tipo, folio, closeFunction, element){
        CloseResponse();
        if(accion=="Verificar"){
            $('#ResponseCancelQuestion').text('¿Estás seguro de que deseas verificar este registro?');
            $('#ResponseCancelWarning').text('⚠️ Una vez verificado, no se podrá deshacer ⚠️');
            $('#ResponseCancelTextarea').css('display', 'none');
            $('.ResponseCancelButton').css('display', 'none');
            $('.ResponseVerifyButton').css('display', 'flex');
        } else if(accion=="Cancelar"){
            $('#ResponseCancelQuestion').text('¿Estás seguro de que deseas cancelar este registro?');
            $('#ResponseCancelWarning').text('⚠️ Una vez cancelado, no se podrá reactivar ⚠️');
            $('#ResponseCancelTextarea').css('display', 'block');
            $('.ResponseCancelButton').css('display', 'flex');
            $('.ResponseVerifyButton').css('display', 'none');

        }
        $('#ResponseDocCont').css('display', 'flex');
        $('#ResponseCancel').css('display', 'flex');
        $('.ResponseTitle h2').text(title);
        $('#ResponseCancel .ResponseCancelButton').off('click').on('click', function() {accionesRegistros(accion, tipo, folio, element);});
        $('#ResponseCancel .ResponseVerifyButton').off('click').on('click', function() {accionesRegistros(accion, tipo, folio, element);});
        $('.CancelResponseDocClose').off('click').on('click', closeFunction);
    }

    function ResponseError(id){
        CloseResponse();
        event.preventDefault(); 
        $('#ResponseDocCont').css('display', 'flex');
        $('#ResponseError').css('display', 'flex');
        // $('.ResponseTitle h2').text(title);
        $('#ResponseError .ResponseErrorButton').off('click').on('click', function() {marcarRegistro(id);});
    }

    function ResponseFull(id, erroranterior) {
    CloseResponse();
    event.preventDefault();
    $('#ResponseDocCont').css('display', 'flex');
    $('#ResponseFull').css('display', 'flex');
    $('#ResponseFullTextarea').val(erroranterior);
    $('#ResponseFull .ResponseFullButton').off('click').on('click', function() {
        RemarcarRegistro(id);
    });
    
}





    function uncheckSlider(element) {
        CloseResponse();
        element.checked = false;
        $('.ResponseCancelNote').val('');
    }

    function ResponseModify(title, folio, tipo, closeFunction){
        CloseResponse();
        if(tipo == "Entrada") {
            $('#ContFormModify').html(ResponseModifyForm(folio, 'FormEntrada'));
            console.log(ResponseModifyForm(folio, 'FormEntrada'));
        } else if(tipo == "Salida") {
            $('#ContFormModify').html(ResponseModifyForm(folio, 'FormSalida'));
        }
        $('#folio').val(folio);
        $('#ResponseDocCont').css('display', 'flex');
        $('#ResponseModify').css('display', 'flex');
        $('.ResponseTitle h2').text(title);
        $('.ResponseModifyClose').attr('onclick', closeFunction);
    }
    async function ResponseModifyForm(folio, accion){
        try {
            const formData = new FormData();
            formData.append('folio', folio);
            formData.append('accion', accion);

            const response = await fetch('accionesRegistros.php', {
                method: 'POST',
                body: formData
            });
            if (response.ok) {
                return await response.text();
            } else {
                throw new Error('Error en la respuesta del servidor');
            }
        } catch (error) {
            return error;
        }
    }

    function generarEntradasyPDF(datoAEnviar, orientacion, toDownload) {
        WaitDoc("Generando registro...", "Por favor espere un momento", "CloseResponse()");
        // Enviar los datos a enviarEntradas.php para darle formato HTML-->>PDF y/o guardar en BD
        $.ajax({
            url: 'enviarEntradas.php',
            type: 'POST',
            data: datoAEnviar,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(datoAEnviar);
                console.log(data);
                console.log(response);
                // Extraer el folio del registro de la respuesta HTML
                if (toDownload) {
                    var parser = new DOMParser();
                    var htmlDoc = parser.parseFromString(response, 'text/html');
                    var folio = htmlDoc.querySelector('#folioElement').innerText;
                }

                // Envia los datos para generar el PDF a generatePDF.php
                $.ajax({
                    url: 'generatePDF.php',
                    type: 'POST',
                    data: {
                        html: response,
                        orientation: orientacion
                    },
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function (response) {
                        // Crea un objeto Blob con los datos del PDF, esto para que pueda ser leído por el elemento object
                        var blob = new Blob([response], {
                            type: 'application/pdf'
                        });

                        // Crea un enlace para descargar el PDF
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        ResponseDoc("Registro generado exitosamente", link.href, link.download, 'window.location.reload()');
                        if (toDownload) {
                            // Obtiene la fecha actual y Formatea la fecha en el formato 'dia-mes-año para Asignar el nombre al archivo'
                            var date = new Date();
                            var formattedDate = date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear();
                            link.download = 'ENTRADA ' + folio + ' ' + formattedDate + '.pdf';
                            link.click();
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr, status, error);
                        WaitDoc("Error al generar el archivo PDF", "Por favor intente de nuevo", "CloseResponse()");
                    }
                });

            },
            error: function (xhr, status, error) {
                // Maneja los errores aquí
                console.error(xhr, status, error);
                WaitDoc("Error al generar el registro", "Por favor intente de nuevo", "CloseResponse()");
            }
        });
        data = null;
        blob = null;
    }

    function consultarPDFEntradas(datoAEnviar, orientacion, toDownload) {
        WaitDoc("Generando registro...", "Por favor espere un momento", "CloseResponse()");
        // Enviar los datos a enviarEntradas.php para darle formato HTML-->>PDF y/o guardar en BD
        $.ajax({
            url: 'enviarEntradas.php',
            type: 'POST',
            data: {
                folio: datoAEnviar
            },
            success: function (response) {
                // Extraer el folio del registro de la respuesta HTML
                if (toDownload) {
                    var parser = new DOMParser();
                    var htmlDoc = parser.parseFromString(response, 'text/html');
                    var folio = htmlDoc.querySelector('#folioElement').innerText;
                }

                // Envia los datos para generar el PDF a generatePDF.php
                $.ajax({
                    url: 'generatePDF.php',
                    type: 'POST',
                    data: {
                        html: response,
                        orientation: orientacion
                    },
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function (response) {
                        // Crea un objeto Blob con los datos del PDF, esto para que pueda ser leído por el elemento object
                        var blob = new Blob([response], {
                            type: 'application/pdf'
                        });

                        // Crea un enlace para descargar el PDF
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        ResponseDoc("Registro generado exitosamente", link.href, link.download);
                        if (toDownload) {
                            // Obtiene la fecha actual y Formatea la fecha en el formato 'dia-mes-año para Asignar el nombre al archivo'
                            var date = new Date();
                            var formattedDate = date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear();
                            link.download = 'ENTRADA ' + folio + ' ' + formattedDate + '.pdf';
                            link.click();
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr, status, error);
                        WaitDoc("Error al generar el archivo PDF", "Por favor intente de nuevo", "CloseResponse()");
                    }
                });

            },
            error: function (xhr, status, error) {
                // Maneja los errores aquí
                console.error(xhr, status, error);
                WaitDoc("Error al generar el registro", "Por favor intente de nuevo", "CloseResponse()");
            }
        });
        data = null;
        blob = null;
    }

    function subirDocumentos(targetDirectory, nombrePersonalizado, accion) {
        WaitDoc("Subiendo tus documentos...", "Por favor espere un momento...", "CloseResponse()");
        var nombre = "";
        switch(accion){
            case "IDBeneficiario":
                nombre="ID Beneficiario";
                break;
            case "Domicilio":
                nombre="Comprobante de domicilio";
                break;
            case "Indicacion":
                nombre="Indicación Médica";
                break;
            case "FotoE": nombre="Foto de Entrega"; break;
            case "AEstudios":nombre="Estudios"; break;
            case "AINE": nombre="INE";break;
            case "AIDBeneficiario": nombre="ID Beneficiario"; break;
            case "ACURP": nombre="CURP"; break;
            case "ADomicilio": nombre="Comprobante de domicilio"; break;
            case "AIndicacion": nombre="Indicación Médica"; break;
            case "ASolicitud": nombre="Solicitud"; break;
            case "AFoto": nombre="Foto";break;
            case "AFotoE":nombre="Foto de Entrega"; break;
            case "ARecibo": nombre="ID Beneficiario"; break;
            default: nombre = accion;
        }
        var folio = document.getElementById("folio").value;
        var docs = document.getElementById("SubirDocs").files[0]; // Acceder al archivo seleccionado
        var targetDirectory = targetDirectory;
        var nombrePersonalizado = nombrePersonalizado;
        var formData = new FormData();
        formData.append("docs", docs);
        formData.append("targetDirectory", targetDirectory);
        formData.append("targetFolio", folio);
        formData.append("docsName", 'ARCHIVOS ' + folio + '.pdf');
        formData.append("nombrePersonalizado", nombrePersonalizado);

        $.ajax({
            url: 'enviarEntradas.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                if (response != "") {
                    ResponseDocEditable("Documento ("+nombre+") subido exitosamente", response, 'location.reload()', 'UploadDoc("Reemplaza tu documento: '+nombre+'","'+folio+'","'+ accion +'")');
                } else {
                    WaitDoc("Error al subir el documento " +nombre+".", "Por favor intente de nuevo", "CloseResponse()");
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr, status, error);
                WaitDoc("Error al enviar los documentos al servidor", "Por favor intente de nuevo", "CloseResponse()");
            }
        });
        data = null;
        blob = null;
    }

    function consultarDoc(folio, tipo, rol, isEditable) {
        $.ajax({
            url: 'enviarEntradas.php',
            type: 'POST',
            data: {
                folioDocs: folio,
                tipo: tipo
            },
            success: function (response) {
                console.log("Response: " + response);
                console.log("editable: " + isEditable);
                if (isEditable) {
                    ResponseDocEditable("Documentos subidos", response, 'CloseResponse()', 'UploadDoc("Reemplaza tus documentos", ' + folio + ')');
                } else {
                    ResponseDoc("Documentos subidos", response, 'ARCHIVOS ' + folio + '.pdf', 'CloseResponse()');

                }
            },
            error: function (xhr, status, error) {
                console.error(xhr, status, error);
                WaitDoc("Error al consultar los documentos", "Por favor intente de nuevo", "CloseResponse()");
            }
        });
        data = null;
        blob = null;
    }

    function generarSalidasyPDF(datoAEnviar, orientacion, toDownload) {
        WaitDoc("Generando registro...", "Por favor espere un momento", "CloseResponse()");
        // Enviar los datos a enviarSalidas.php para darle formato HTML-->>PDF y/o guardar en BD
        $.ajax({
            url: 'enviarSalidas.php',
            type: 'POST',
            data: datoAEnviar,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(datoAEnviar);
                console.log(data);
                console.log(response);
                // Extraer el folio del registro de la respuesta HTML
                if (toDownload) {
                    var parser = new DOMParser();
                    var htmlDoc = parser.parseFromString(response, 'text/html');
                    var folio = htmlDoc.querySelector('#folioElement').innerText;
                }

                // Envia los datos para generar el PDF a generatePDF.php
                $.ajax({
                    url: 'generatePDF.php',
                    type: 'POST',
                    data: {
                        html: response,
                        orientation: orientacion
                    },
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function (response) {
                        // Crea un objeto Blob con los datos del PDF, esto para que pueda ser leído por el elemento object
                        var blob = new Blob([response], {
                            type: 'application/pdf'
                        });

                        // Crea un enlace para descargar el PDF
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        ResponseDoc("Registro generado exitosamente", link.href, link.download, 'window.location.reload()');
                        if (toDownload) {
                            // Obtiene la fecha actual y Formatea la fecha en el formato 'dia-mes-año para Asignar el nombre al archivo'
                            var date = new Date();
                            var formattedDate = date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear();
                            link.download = 'SALIDA ' + folio + ' ' + formattedDate + '.pdf';
                            link.click();
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr, status, error);
                        WaitDoc("Error al generar el archivo PDF", "Por favor intente de nuevo", "CloseResponse()");
                    }
                });

            },
            error: function (xhr, status, error) {
                // Maneja los errores aquí
                console.error(xhr, status, error);
                WaitDoc("Error al generar el registro", "Por favor intente de nuevo", "CloseResponse()");
            }
        });
        data = null;
        blob = null;
    }

    function consultarPDFSalidas(datoAEnviar, orientacion, toDownload) {
        WaitDoc("Generando registro...", "Por favor espere un momento", "CloseResponse()");
        // Enviar los datos a enviarEntradas.php para darle formato HTML-->>PDF y/o guardar en BD
        $.ajax({
            url: 'enviarSalidas.php',
            type: 'POST',
            data: {
                folio: datoAEnviar
            },
            success: function (response) {
                // Extraer el folio del registro de la respuesta HTML
                if (toDownload) {
                    var parser = new DOMParser();
                    var htmlDoc = parser.parseFromString(response, 'text/html');
                    var folio = htmlDoc.querySelector('#folioElement').innerText;
                }

                // Envia los datos para generar el PDF a generatePDF.php
                $.ajax({
                    url: 'generatePDF.php',
                    type: 'POST',
                    data: {
                        html: response,
                        orientation: orientacion
                    },
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function (response) {
                        // Crea un objeto Blob con los datos del PDF, esto para que pueda ser leído por el elemento object
                        var blob = new Blob([response], {
                            type: 'application/pdf'
                        });

                        // Crea un enlace para descargar el PDF
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        ResponseDoc("Registro generado exitosamente", link.href, link.download);
                        if (toDownload) {
                            // Obtiene la fecha actual y Formatea la fecha en el formato 'dia-mes-año para Asignar el nombre al archivo'
                            var date = new Date();
                            var formattedDate = date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear();
                            link.download = 'ENTRADA ' + folio + ' ' + formattedDate + '.pdf';
                            link.click();
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr, status, error);
                        WaitDoc("Error al generar el archivo PDF", "Por favor intente de nuevo", "CloseResponse()");
                    }
                });

            },
            error: function (xhr, status, error) {
                // Maneja los errores aquí
                console.error(xhr, status, error);
                WaitDoc("Error al generar el registro", "Por favor intente de nuevo", "CloseResponse()");
            }
        });
        data = null;
        blob = null;
    }

    function eliminarRegistro(id){
        accion = "eliminar"
        $.ajax({
            url: 'handlepersona.php',
            type: 'POST',
            data: {
                id: id,
                accion: accion
            },
            success: function (response) {
                console.log(response);
                if(response == "Success"){
                    WaitDoc("Registro eliminado exitosamente", "La solicitud de eliminación ha sido procesada con éxito.", "location.reload()");
                } else {
                    console.log(response);
                    WaitDoc("Error al eliminar el registro", "Por favor intente de nuevo", "CloseResponse()");
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr, status, error);
                WaitDoc("Error al cancelar el registro", "Por favor intente de nuevo", "CloseResponse()");
            }
        });
    }

    function eliminarRegistroA(id){
        accion = "eliminar"
        $.ajax({
            url: 'handleApoyados.php',
            type: 'POST',
            data: {
                id: id,
                accion: accion
            },
            success: function (response) {
                console.log(response);
                if(response == "Success"){
                    WaitDoc("Registro eliminado exitosamente", "La solicitud de eliminación ha sido procesada con éxito.", "location.reload()");
                } else {
                    console.log(response);
                    WaitDoc("Error al eliminar el registro", "Por favor intente de nuevo", "CloseResponse()");
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr, status, error);
                WaitDoc("Error al cancelar el registro", "Por favor intente de nuevo", "CloseResponse()");
            }
        });
    }

    function validarRegistro(id, supervisor){
        accion = "validar"
        $.ajax({
            url: 'handlepersona.php',
            type: 'POST',
            data: {
                id: id,
                supervisor: supervisor,
                accion: accion
            },
            success: function (response) {
                console.log(response);
                if(response == "Success"){
                    WaitDoc("Registro validado exitosamente", "La solicitud de validación ha sido procesada con éxito.", "location.reload()");
                } else {
                    console.log(response);
                    WaitDoc("Error al validar el registro", "Por favor intente de nuevo", "CloseResponse()");
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr, status, error);
                WaitDoc("Error al cancelar el registro", "Por favor intente de nuevo", "CloseResponse()");
            }
        });
    }

    function validarRegistroA(id, supervisor){
        accion = "validar"
        $.ajax({
            url: 'handleApoyados.php',
            type: 'POST',
            data: {
                id: id,
                supervisor: supervisor,
                accion: accion
            },
            success: function (response) {
                console.log(response);
                if(response == "Success"){
                    WaitDoc("Registro validado exitosamente", "La solicitud de validación ha sido procesada con éxito.", "location.reload()");
                } else {
                    console.log(response);
                    WaitDoc("Error al validar el registro", "Por favor intente de nuevo", "CloseResponse()");
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr, status, error);
                WaitDoc("Error al cancelar el registro", "Por favor intente de nuevo", "CloseResponse()");
            }
        });
    }

    function accionesRegistros(accion, tipo, folio, element){
        var nota = $('#ResponseCancel .ResponseCancelNote').val();

        $.ajax({
            url: 'accionesRegistros.php',
            type: 'POST',
            data: {
                folio: folio,
                tipo: tipo,
                nota: nota,
                accion: accion
            },
            success: function (response) {
                console.log(response);
                if(response == "Success" && accion == "Cancelar"){
                    WaitDoc("Registro " + folio + " cancelado exitosamente", "La solicitud de cancelación ha sido procesada con éxito.", "location.reload()");
                    element.disabled = true;
                } else if(response != "Success" && accion == "Cancelar"){
                    console.log(response + "\n Por favor");
                    WaitDoc("Error al cancelar el registro", response + "\n Por favor intente de nuevo", function() {uncheckSlider(element);});
                }else if(response == "Success" && accion == "Verificar"){
                    WaitDoc("Registro " + folio + " verificado exitosamente", "La solicitud de verificación ha sido procesada con éxito.", "location.reload()");
                    element.disabled = true;
                } else {
                    console.log(response);
                    WaitDoc("Error al verificar el registro", "Por favor intente de nuevo", function() {uncheckSlider(element);});
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr, status, error);
                WaitDoc("Error al cancelar el registro", "Por favor intente de nuevo", "CloseResponse()");
            }
        });
    }


    function marcarRegistro(id){
        var nota = $('#ResponseError .ResponseErrorNote').val();
        accion = "comentar"
        $.ajax({
            url: 'handlepersona.php',
            type: 'POST',
            data: {
                id: id,
                accion: accion,
                nota: nota
            },
            success: function (response) {
                console.log(response);
                if(response == "Success"){
                    WaitDoc("Comentario enviado exitosamente", "El comentario ha sido enviado.", "location.reload()");
                } else {
                    console.log(response);
                    WaitDoc("Error al enviar el comentario", "Por favor intente de nuevo.", "CloseResponse()");
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr, status, error);
                WaitDoc("Error al enviar el comentario", "Por favor, intente más tarde.", "CloseResponse()");
            }
        });
    }

    function RemarcarRegistro(id){
        var nota = $('#ResponseFull .ResponseFullNote').val();
        accion = "comentar"
        $.ajax({
            url: 'handlepersona.php',
            type: 'POST',
            data: {
                id: id,
                accion: accion,
                nota: nota
            },
            success: function (response) {
                console.log(response);
                if(response == "Success"){
                    WaitDoc("Comentario enviado exitosamente", "El comentario ha sido enviado.", "location.reload()");
                } else {
                    console.log(response);
                    WaitDoc("Error al enviar el comentario", "Por favor intente de nuevo.", "CloseResponse()");
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr, status, error);
                WaitDoc("Error al enviar el comentario", "Por favor, intente más tarde.", "CloseResponse()");
            }
        });
    }






    // Drag and drop file input
    document.addEventListener("DOMContentLoaded", function () {
        const inputFileCont = document.querySelector(".inputFileLabel"); // Cambiado a querySelector
        const fileInput = document.getElementById("SubirDocs");

        if (inputFileCont) {
            inputFileCont.addEventListener("dragover", (e) => {
                e.preventDefault();
            });

            inputFileCont.addEventListener("dragenter", (e) => {
                e.preventDefault();
                inputFileCont.classList.add("drag-active");
            });

            inputFileCont.addEventListener("dragleave", (e) => {
                e.preventDefault();
                inputFileCont.classList.remove("drag-active");
            });

            inputFileCont.addEventListener("drop", (e) => {
                e.preventDefault();
                inputFileCont.classList.remove("drag-active");
                fileInput.files = e.dataTransfer.files;
            });
        }
    });

    // document.getElementById('FormModificarEntrada').addEventListener('submit', async function(event) {
    //     event.preventDefault();
    //     const form = event.target;
    //     const formData = new FormData(form);
    //     formData.append('accion', 'modificarEntrada');

    //     try {
    //         const response = await fetch('handleAdministradores.php', {
    //             method: 'POST',
    //             body: formData
    //         });
    //         if (response.ok) {
    //             const result = await response.text();
    //             console.log(result);
    //             if (result === "Success") {
    //                 WaitDoc('Modificar entrada', 'La entrada fue modificada correctamente', 'location.reload()');
    //             } else {
    //                 WaitDoc('Error al modificar entrada', result, 'location.reload()');
    //             }
    //         } else {
    //             throw new Error('Error en la respuesta del servidor');
    //         }
    //     } catch (error) {
    //         console.error('Error:', error);
    //         WaitDoc('Error al modificar la entrada', error, 'location.reload()');
    //     }
    // });


</script>