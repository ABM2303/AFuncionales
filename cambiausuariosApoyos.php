<?php
include 'conexion.php';
// Establish database connection
$conn = conectar();
if (empty($conn) || !($conn instanceof mysqli)) {
    $error = "⛔Error de conexión: <br>" . $conn;
}

// Si no hay una sesión iniciada, iniciarla
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    // Si no hay un usuario loggeado, redirigir a la página de login
    if(!isset($_SESSION['usuario']) || !$_SESSION['LoggedIn']){
        header('Location: login.php');
    }
    $idusuario = $_POST['usuario'];
?>
<head>
    <!-- Include common resources -->
    <?php include 'commonResources.php'; ?>
    
    <title>Apoyos directos</title>
    <!-- Styles -->
    <link rel="stylesheet" href="Styles/controlUsuariosStyles.css">
</head>
<?php if (isset($error)) { ?>
    <div id="Errores">
        <div id="Error">
            <p><?php echo $error; ?></p>
        </div>
    </div>
<?php } ?>

<!-- Include header principal -->
<?php include 'header.php'; ?>
<!-- Include ventana de respuesta -->
<?php include 'ventanaResponse.php'; ?>

<!-- Tabla de beneficiarios -->
        <div id="ContenidoUsuarios">
<div id="ConfiguracionesUsuario" class="OpcMenuContent">
<h1>Apoyos directos</h1>
<h3>Beneficiarios existentes</h3>
<hr>
<!-- Tabla de usuarios -->
<table id='tablaUsuarios'>
    <thead>
        <tr>
            <th>ID</th>
            <th>CURP</th>
            <th>Nombre(s)</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Apoyo</th>
            <th>Monto</th>
            <th>Estudios</th>
            <th>INE Solicitante</th>
            <th>Identificación del Beneficiario</th>
            <th>CURP</th>
            <th>Comprobante de domicilio</th>
            <th>Indicación médica</th>
            <th>Solicitud</th>
            <th>Foto</th>
            <th>Foto de Entrega</th>
            <th>Recibo</th>
            <th>Factura</th>
            <th>Modificar</th>
            <th>Eliminar</th>
            <th>Validar</th>
        </tr>
    </thead>
    <tbody>
        
        <?php
            $supervisor=$_SESSION['id'];
            $conn = conectar();
            $query = $conn->prepare("SELECT id_apoyado, curp, nombres, paterno, materno, id_apoyo, monto, validado, comentario FROM apoyado WHERE id_usuario=$idusuario");
            $query->execute();
            $query->bind_result($id_benficiario, $curp, $nombre, $paterno, $materno, $apoyo, $monto, $validado, $comentario);
            $query->store_result();
            while($query->fetch()){
                $comentario = trim($comentario);
                $comentario = str_replace(array("\r\n", "\r", "\n"), " ", $comentario);
                $comentario = addslashes($comentario);
                if($validado == "Si"){
                    echo "<tr class='tablaVerificado'>";
                    echo "<td>$id_benficiario</td>";
                    echo "<td>$curp</td>";
                    echo "<td>$nombre</td>";
                    echo "<td>$paterno</td>";
                    echo "<td>$materno</td>";
                    $query3 = $conn->prepare("SELECT tipo_apoyo FROM apoyos WHERE id_apoyo = $apoyo");
                    $query3->execute();
                    $query3->bind_result($tipoapoyo);
                    $query3->store_result();
                    while($query3->fetch()){
                        echo "<td>$tipoapoyo</td>";
                    }
                    echo "<td>$monto</td>"; 

                    // PDF de Estudios
                    if(file_exists("IMGAPOYOS2024/Estudios/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $estudios = "IMGAPOYOS2024/Estudios/$id_benficiario.pdf";
                        echo "<td><button data-tooltip='Ver documento' onclick=\"ResponseDoc('Documento: Estudios','$estudios', '$estudios', 'CloseResponse()')\"><i class='bi bi-file-earmark-pdf'></i></button></td>";
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Estudios)', '$id_benficiario', 'Estudios')\" disabled><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF INE
                    if(file_exists("IMGAPOYOS2024/INE/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $INE = "IMGAPOYOS2024/INE/$id_benficiario.pdf";
                        echo "<td><button data-tooltip='Ver documento' onclick=\"ResponseDoc('Documento: INE','$INE', '$INE', 'CloseResponse()')\"><i class='bi bi-file-earmark-pdf'></i></button></td>";
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (INE)', '$id_benficiario', 'INE')\" disabled><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF Identificacion del beneficiario
                    if(file_exists("IMGAPOYOS2024/IdBeneficiario/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $idben = "IMGAPOYOS2024/IdBeneficiario/$id_benficiario.pdf";
                        echo "<td><button data-tooltip='Ver documento' onclick=\"ResponseDoc('Documento: Identificación beneficiario','$idben', '$idben', 'CloseResponse()')\"><i class='bi bi-file-earmark-pdf'></i></button></td>";
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Identificacion beneficiario)', '$id_benficiario', 'IDBeneficiario')\" disabled><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF CURP
                    if(file_exists("IMGAPOYOS2024/CURP/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $curpdoc = "IMGAPOYOS2024/CURP/$id_benficiario.pdf";
                        echo "<td><button data-tooltip='Ver documento' onclick=\"ResponseDoc('Documento: CURP','$curpdoc', '$curpdoc', 'CloseResponse()')\"><i class='bi bi-file-earmark-pdf'></i></button></td>";
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (CURP)', '$id_benficiario', 'CURP')\" disabled><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF Comprobante de domicilio
                    if(file_exists("IMGAPOYOS2024/Domicilio/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $domicilio = "IMGAPOYOS2024/Domicilio/$id_benficiario.pdf";
                        echo "<td><button data-tooltip='Ver documento' onclick=\"ResponseDoc('Documento: Comprobante de domicilio','$domicilio', '$domicilio', 'CloseResponse()')\"><i class='bi bi-file-earmark-pdf'></i></button></td>";
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Comprobante de domicilio)', '$id_benficiario', 'Domicilio')\" disabled><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF Indicacion medica
                    if(file_exists("IMGAPOYOS2024/Indicacion/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $medica = "IMGAPOYOS2024/Indicacion/$id_benficiario.pdf";
                        echo "<td><button data-tooltip='Ver documento' onclick=\"ResponseDoc('Documento: Indicación médica','$medica', '$medica', 'CloseResponse()')\"><i class='bi bi-file-earmark-pdf'></i></button></td>";
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Indicación médica)', '$id_benficiario', 'Indicacion')\" disabled><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF Solicitud
                    if(file_exists("IMGAPOYOS2024/Solicitud/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $solicitud = "IMGAPOYOS2024/Solicitud/$id_benficiario.pdf";
                        echo "<td><button data-tooltip='Ver documento' onclick=\"ResponseDoc('Documento: Solicitud','$solicitud', '$solicitud', 'CloseResponse()')\"><i class='bi bi-file-earmark-pdf'></i></button></td>";
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Solicitud)', '$id_benficiario', 'Solicitud')\" disabled><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF Foto
                    if(file_exists("IMGAPOYOS2024/Foto/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $foto = "IMGAPOYOS2024/Foto/$id_benficiario.pdf";
                        echo "<td><button data-tooltip='Ver documento' onclick=\"ResponseDoc('Documento: Foto','$foto', '$foto', 'CloseResponse()')\"><i class='bi bi-file-earmark-pdf'></i></button></td>";
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Foto)', '$id_benficiario', 'Foto')\" disabled><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF Foto de entrega
                    if(file_exists("IMGAPOYOS2024/FotoEntrega/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $fotoE = "IMGAPOYOS2024/FotoEntrega/$id_benficiario.pdf";
                        echo "<td><button data-tooltip='Ver documento' onclick=\"ResponseDoc('Documento: Foto de Entrega','$fotoE', '$fotoE', 'CloseResponse()')\"><i class='bi bi-file-earmark-pdf'></i></button></td>";
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Foto de Entrega)', '$id_benficiario', 'FotoE')\" disabled><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF Recibo
                    if(file_exists("IMGAPOYOS2024/Recibo/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $recibo = "IMGAPOYOS2024/Recibo/$id_benficiario.pdf";
                        echo "<td><button data-tooltip='Ver documento' onclick=\"ResponseDoc('Documento: Recibo','$recibo', '$recibo', 'CloseResponse()')\"><i class='bi bi-file-earmark-pdf'></i></button></td>";
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Recibo)', '$id_benficiario', 'Recibo')\" disabled><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF Factura
                    if(file_exists("IMGAPOYOS2024/Factura/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $factura = "IMGAPOYOS2024/Factura/$id_benficiario.pdf";
                        echo "<td><button data-tooltip='Ver documento' onclick=\"ResponseDoc('Documento: Factura','$factura', '$factura', 'CloseResponse()')\"><i class='bi bi-file-earmark-pdf'></i></button></td>";
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Factura)', '$id_benficiario', 'Factura')\" disabled><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // Boton de editar
                    echo "<td><a href='editarBeneficiario.php?id=$id_benficiario'><button disabled><i class='bi bi-pencil'></i></button></a></td>";
                    
                    // Boton de eliminar
                    echo "<td><button data-tooltip='Eliminar registro' onclick=\"ResponseDelete($id_benficiario)\" disabled><i class='bi bi-trash3'></i></button></td>";

                    // Boton Validar
                    echo "<td><a data-tooltip='Validar' onclick=\"\" disabled><label class='switch'><input type='checkbox' checked disabled><span class='slider round'></span></label></a></td>";
                    
                    echo "</tr>";
                }else{
                    echo "<tr>";
                    echo "<td>$id_benficiario</td>";
                    echo "<td>$curp</td>";
                    echo "<td>$nombre</td>";
                    echo "<td>$paterno</td>";
                    echo "<td>$materno</td>";
                    $query3 = $conn->prepare("SELECT tipo_apoyo FROM apoyos WHERE id_apoyo = $apoyo");
                    $query3->execute();
                    $query3->bind_result($tipoapoyo);
                    $query3->store_result();
                    while($query3->fetch()){
                        echo "<td>$tipoapoyo</td>";
                    }
                    echo "<td>$$monto</td>"; 
                    
                    // PDF Estudios
                    if(file_exists("IMGAPOYOS2024/Estudios/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $estudios = "IMGAPOYOS2024/Estudios/$id_benficiario.pdf";
                       echo <<<EOT
                        <td><button data-tooltip='Ver documento' onclick='ResponseDocEditable("Documento: Estudios", "$estudios", "CloseResponse()", "UploadDoc(\"Reemplaza tu documento: Estudios\", \"$id_benficiario\", \"AEstudios\")")'><i class='bi bi-file-earmark-pdf'></i></button></td>
                        EOT;
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Estudios)', '$id_benficiario', 'AEstudios')\"><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF INE
                    if(file_exists("IMGAPOYOS2024/INE/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $INE = "IMGAPOYOS2024/INE/$id_benficiario.pdf";
                        echo <<<EOT
                        <td><button data-tooltip='Ver documento' onclick='ResponseDocEditable("Documento: INE", "$INE", "CloseResponse()", "UploadDoc(\"Reemplaza tu documento: INE\", \"$id_benficiario\", \"AINE\")")'><i class='bi bi-file-earmark-pdf'></i></button></td>
                        EOT;
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (INE)', '$id_benficiario', 'AINE')\"><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF Identificacion del beneficiario
                    if(file_exists("IMGAPOYOS2024/IdBeneficiario/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $idben = "IMGAPOYOS2024/IdBeneficiario/$id_benficiario.pdf";
                        echo <<<EOT
                        <td><button data-tooltip='Ver documento' onclick='ResponseDocEditable("Documento: Identificacion Beneficiario", "$idben", "CloseResponse()", "UploadDoc(\"Reemplaza tu documento: Id.Beneficiario\", \"$id_benficiario\", \"AIDBeneficiario\")")'><i class='bi bi-file-earmark-pdf'></i></button></td>
                        EOT;
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Identificación beneficiario)', '$id_benficiario', 'AIDBeneficiario')\"><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF CURP
                    if(file_exists("IMGAPOYOS2024/CURP/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $curpdoc = "IMGAPOYOS2024/CURP/$id_benficiario.pdf";
                        echo <<<EOT
                        <td><button data-tooltip='Ver documento' onclick='ResponseDocEditable("Documento: CURP", "$curpdoc", "CloseResponse()", "UploadDoc(\"Reemplaza tu documento: CURP\", \"$id_benficiario\", \"ACURP\")")'><i class='bi bi-file-earmark-pdf'></i></button></td>
                        EOT;
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (CURP)', '$id_benficiario', 'ACURP')\"><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF Comprobante de domicilio
                    if(file_exists("IMGAPOYOS2024/Domicilio/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $domicilio = "IMGAPOYOS2024/Domicilio/$id_benficiario.pdf";
                        echo <<<EOT
                        <td><button data-tooltip='Ver documento' onclick='ResponseDocEditable("Documento: Comprobante de Domicilio", "$domicilio", "CloseResponse()", "UploadDoc(\"Reemplaza tu documento: Domicilio\", \"$id_benficiario\", \"ADomicilio\")")'><i class='bi bi-file-earmark-pdf'></i></button></td>
                        EOT;
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Comprobante de domicilio)', '$id_benficiario', 'ADomicilio')\"><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF Indicacion medica
                    if(file_exists("IMGAPOYOS2024/Indicacion/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $medica = "IMGAPOYOS2024/Indicacion/$id_benficiario.pdf";
                        echo <<<EOT
                        <td><button data-tooltip='Ver documento' onclick='ResponseDocEditable("Documento: Indicacion medica", "$medica", "CloseResponse()", "UploadDoc(\"Reemplaza tu documento: Indicación médica\", \"$id_benficiario\", \"AIndicacion\")")'><i class='bi bi-file-earmark-pdf'></i></button></td>
                        EOT;
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Indicación médica)', '$id_benficiario', 'AIndicacion')\"><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF Solicitud
                    if(file_exists("IMGAPOYOS2024/Solicitud/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $solicitud = "IMGAPOYOS2024/Solicitud/$id_benficiario.pdf";
                        echo <<<EOT
                        <td><button data-tooltip='Ver documento' onclick='ResponseDocEditable("Documento: Solicitud", "$solicitud", "CloseResponse()", "UploadDoc(\"Reemplaza tu documento: Solicitud\", \"$id_benficiario\", \"ASolicitud\")")'><i class='bi bi-file-earmark-pdf'></i></button></td>
                        EOT;
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Solicitud)', '$id_benficiario', 'ASolicitud')\"><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF Foto
                    if(file_exists("IMGAPOYOS2024/Foto/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $foto = "IMGAPOYOS2024/Foto/$id_benficiario.pdf";
                        echo <<<EOT
                        <td><button data-tooltip='Ver documento' onclick='ResponseDocEditable("Documento: Foto", "$foto", "CloseResponse()", "UploadDoc(\"Reemplaza tu documento: Foto\", \"$id_benficiario\", \"AFoto\")")'><i class='bi bi-file-earmark-pdf'></i></button></td>
                        EOT;
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Foto)', '$id_benficiario', 'AFoto')\"><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF Foto de Entrega
                    if(file_exists("IMGAPOYOS2024/FotoEntrega/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $fotoE = "IMGAPOYOS2024/FotoEntrega/$id_benficiario.pdf";
                        echo <<<EOT
                        <td><button data-tooltip='Ver documento' onclick='ResponseDocEditable("Documento: Foto de Entrega", "$fotoE", "CloseResponse()", "UploadDoc(\"Reemplaza tu documento: FotoEntrega\", \"$id_benficiario\", \"AFotoE\")")'><i class='bi bi-file-earmark-pdf'></i></button></td>
                        EOT;
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Foto de Entrega)', '$id_benficiario', 'AFotoE')\"><i class='bi bi-cloud-upload'></i></button></td>";
                    }
 
                    // PDF Recibo
                    if(file_exists("IMGAPOYOS2024/Recibo/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $recibo = "IMGAPOYOS2024/Recibo/$id_benficiario.pdf";
                        echo <<<EOT
                        <td><button data-tooltip='Ver documento' onclick='ResponseDocEditable("Documento: Recibo", "$recibo", "CloseResponse()", "UploadDoc(\"Reemplaza tu documento: Recibo\", \"$id_benficiario\", \"ARecibo\")")'><i class='bi bi-file-earmark-pdf'></i></button></td>
                        EOT;
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Recibo)', '$id_benficiario', 'ARecibo')\"><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF Factura
                    if(file_exists("IMGAPOYOS2024/Factura/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $factura = "IMGAPOYOS2024/Factura/$id_benficiario.pdf";
                        echo <<<EOT
                        <td><button data-tooltip='Ver documento' onclick='ResponseDocEditable("Documento: Factura", "$factura", "CloseResponse()", "UploadDoc(\"Reemplaza tu documento: Factura\", \"$id_benficiario\", \"Factura\")")'><i class='bi bi-file-earmark-pdf'></i></button></td>
                        EOT;
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Factura)', '$id_benficiario', 'Factura')\"><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    echo "<td><a class='botoneditar' href='editarApoyado.php?id=$id_benficiario'><i class='bi bi-pencil'></i></a></td>";
                    echo "<td><button data-tooltip='Eliminar registro' onclick=\"ResponseDeleteA($id_benficiario)\"><i class='bi bi-trash3'></i></button></td>";
                    echo "<td><a data-tooltip='Validar' onclick=\"ResponseValidarA($id_benficiario,  $supervisor)\"><input type='checkbox'><span class='slider round'></span></a></td>";
                    echo "</tr>";
                }

                
            }
        ?>
    </tbody>
</table>
</div>              
</div>


<script>

    $('#tablaUsuarios').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ beneficiarios por página",
            "zeroRecords": "No se encontraron beneficiarios",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No se encontraron beneficiarios con esos criterios",
            "infoFiltered": "(filtrado de _MAX_ beneficiarios totales)",
            "search": "Buscar:",
            "paginate": {
                "first": "<i class='bi bi-chevron-double-left'></i>",
                "last": "<i class='bi bi-chevron-double-right'></i>",
                "next": "<i class='bi bi-chevron-right'></i>",
                "previous": "<i class='bi bi-chevron-left'></i>"
            }
        },
        "order": [
            [0, "asc"]
        ],
        "columnDefs": [{
            "targets": [3],
            "orderable": false
        }],
        "scrollX": false, // Activar scrollbar horizontal
        "scrollCollapse": true // Colapsar tabla si no hay suficiente contenido para llenar el espacio
    });

</script>
        

