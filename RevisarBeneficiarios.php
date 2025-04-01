<?php
include 'conexion.php';
$conn = conectar();
if (empty($conn) || !($conn instanceof mysqli)) {
    $error = "⛔Error de conexión: <br>" . $conn;
}

function nombraraparato($funcional) {
    $especifico="";
    switch ($funcional){
        case "Ruedas":
            $especifico="Silla de Ruedas";
            break;
        case "PCI":
            $especifico="Silla PCI";
            break;
        case "PCA":
            $especifico="Silla PCA";
            break;
        case 'Bath':
            $especifico="Silla de Baño";
        break;
        case 'Andadera':
            $especifico="Andadera";
        break;
        case 'Baston':
            $especifico="Baston";
        break;
        case 'Baston4':
            $especifico="Baston de 4 puntos";
        break;
        case 'Auditivo':
            $especifico="Aparato Auditivo";
        break;
        case 'Muletas':
            $especifico="Muletas";
        break;
        case 'Optometrico':
            $especifico="Optométrico";
        break;
        case 'Diadema':
            $especifico="Aparatos auditivos (Diadema)";
        break;
        case 'Rinfantil':
            $especifico="Sillas de Ruedas (Infantil)";
        break;
        case 'BInvidente':
            $especifico="Bastones para Invidentes";
        break;
    }
    return $especifico;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Include common resources -->
    <?php include 'commonResources.php'; ?>
    <title>Beneficiarios</title>
    <!-- Styles -->
    <link rel="stylesheet" href="Styles/controlUsuariosStyles.css">
</head>

<body>
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

<h1 class="PageTitle">Lista de Beneficiarios</h1>
<div id="ContenidoUsuarios">
<div id="ConfiguracionesUsuario" class="OpcMenuContent">
<h1>Beneficiarios</h1>
<h3>Beneficiarios existentes</h3>
<hr>
<!-- Tabla de Beneficiarios -->
<table id='tablaUsuarios'>
    <thead>
        <tr>
            <th>ID</th>
            <th>CURP</th>
            <th>Nombre(s)</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Aparato</th>
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
            <th>Modificar</th>
            <th>Eliminar</th>
            <th>Error</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $supervisor=$_SESSION['id'];
            $conn = conectar();
            $query = $conn->prepare("SELECT id_beneficiario, curp, nombres, paterno, materno, aparato, validado, comentario FROM beneficiario WHERE  id_usuario =".$_SESSION['id']);
            $query->execute();
            $query->bind_result($id_benficiario, $curp, $nombre, $paterno, $materno, $aparato, $validado, $comentario);
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
                    $func=nombraraparato($aparato);
                    echo "<td>$func</td>";  

                    // PDF de Estudios
                    if(file_exists("IMGFUNCIONALES2024/Estudios/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $estudios = "IMGFUNCIONALES2024/Estudios/$id_benficiario.pdf";
                        echo "<td><button data-tooltip='Ver documento' onclick=\"ResponseDoc('Documento: Estudios','$estudios', '$estudios', 'CloseResponse()')\"><i class='bi bi-file-earmark-pdf'></i></button></td>";
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Estudios)', '$id_benficiario', 'Estudios')\" disabled><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF INE
                    if(file_exists("IMGFUNCIONALES2024/INE/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $INE = "IMGFUNCIONALES2024/INE/$id_benficiario.pdf";
                        echo "<td><button data-tooltip='Ver documento' onclick=\"ResponseDoc('Documento: INE','$INE', '$INE', 'CloseResponse()')\"><i class='bi bi-file-earmark-pdf'></i></button></td>";
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (INE)', '$id_benficiario', 'INE')\" disabled><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF Identificacion del beneficiario
                    if(file_exists("IMGFUNCIONALES2024/IdBeneficiario/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $idben = "IMGFUNCIONALES2024/IdBeneficiario/$id_benficiario.pdf";
                        echo "<td><button data-tooltip='Ver documento' onclick=\"ResponseDoc('Documento: Identificación beneficiario','$idben', '$idben', 'CloseResponse()')\"><i class='bi bi-file-earmark-pdf'></i></button></td>";
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Identificacion beneficiario)', '$id_benficiario', 'IDBeneficiario')\" disabled><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF CURP
                    if(file_exists("IMGFUNCIONALES2024/CURP/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $curpdoc = "IMGFUNCIONALES2024/CURP/$id_benficiario.pdf";
                        echo "<td><button data-tooltip='Ver documento' onclick=\"ResponseDoc('Documento: CURP','$curpdoc', '$curpdoc', 'CloseResponse()')\"><i class='bi bi-file-earmark-pdf'></i></button></td>";
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (CURP)', '$id_benficiario', 'CURP')\" disabled><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF Comprobante de domicilio
                    if(file_exists("IMGFUNCIONALES2024/Domicilio/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $domicilio = "IMGFUNCIONALES2024/Domicilio/$id_benficiario.pdf";
                        echo "<td><button data-tooltip='Ver documento' onclick=\"ResponseDoc('Documento: Comprobante de domicilio','$domicilio', '$domicilio', 'CloseResponse()')\"><i class='bi bi-file-earmark-pdf'></i></button></td>";
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Comprobante de domicilio)', '$id_benficiario', 'Domicilio')\" disabled><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF Indicacion medica
                    if(file_exists("IMGFUNCIONALES2024/Indicacion/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $medica = "IMGFUNCIONALES2024/Indicacion/$id_benficiario.pdf";
                        echo "<td><button data-tooltip='Ver documento' onclick=\"ResponseDoc('Documento: Indicación médica','$medica', '$medica', 'CloseResponse()')\"><i class='bi bi-file-earmark-pdf'></i></button></td>";
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Indicación médica)', '$id_benficiario', 'Indicacion')\" disabled><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF Solicitud
                    if(file_exists("IMGFUNCIONALES2024/Solicitud/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $solicitud = "IMGFUNCIONALES2024/Solicitud/$id_benficiario.pdf";
                        echo "<td><button data-tooltip='Ver documento' onclick=\"ResponseDoc('Documento: Solicitud','$solicitud', '$solicitud', 'CloseResponse()')\"><i class='bi bi-file-earmark-pdf'></i></button></td>";
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Solicitud)', '$id_benficiario', 'Solicitud')\" disabled><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF Foto
                    if(file_exists("IMGFUNCIONALES2024/Foto/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $foto = "IMGFUNCIONALES2024/Foto/$id_benficiario.pdf";
                        echo "<td><button data-tooltip='Ver documento' onclick=\"ResponseDoc('Documento: Foto','$foto', '$foto', 'CloseResponse()')\"><i class='bi bi-file-earmark-pdf'></i></button></td>";
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Foto)', '$id_benficiario', 'Foto')\" disabled><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF Foto de entrega
                    if(file_exists("IMGFUNCIONALES2024/FotoEntrega/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $fotoE = "IMGFUNCIONALES2024/FotoEntrega/$id_benficiario.pdf";
                        echo "<td><button data-tooltip='Ver documento' onclick=\"ResponseDoc('Documento: Foto de Entrega','$fotoE', '$fotoE', 'CloseResponse()')\"><i class='bi bi-file-earmark-pdf'></i></button></td>";
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Foto de Entrega)', '$id_benficiario', 'FotoE')\" disabled><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF Recibo
                    if(file_exists("IMGFUNCIONALES2024/Recibo/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $recibo = "IMGFUNCIONALES2024/Recibo/$id_benficiario.pdf";
                        echo "<td><button data-tooltip='Ver documento' onclick=\"ResponseDoc('Documento: Recibo','$recibo', '$recibo', 'CloseResponse()')\"><i class='bi bi-file-earmark-pdf'></i></button></td>";
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Recibo)', '$id_benficiario', 'Recibo')\" disabled><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    echo "<td><a href='editarBeneficiario.php?id=$id_benficiario'><button disabled><i class='bi bi-pencil'></i></button></a></td>";
                    echo "<td><button data-tooltip='Eliminar registro' onclick=\"ResponseDelete($id_benficiario)\" disabled><i class='bi bi-trash3'></i></button></td>";
                    if($_SESSION['rol'] == 3){
                        echo "<td><a data-tooltip='Validar' onclick=\"\" disabled><label class='switch'><input type='checkbox' checked disabled><span class='slider round'></span></label></a></td>";
                        echo "<td><button data-tooltip='Comentar un error' onclick=\"\"><i class='bi bi-x-circle'></i></button></td>";
                    }
                    if($_SESSION['rol'] == 2){
                        echo "<td><button data-tooltip='Ver un error' onclick=\"\"><i class='bi bi-x-circle'></i></button></td>";
                    }
                    echo "</tr>";
                }else{
                    if($comentario == NULL){
                        echo "<tr>";
                    }else{
                        echo "<tr class='tablaComentado'>";
                    }
                    echo "<td>$id_benficiario</td>";
                    echo "<td>$curp</td>";
                    echo "<td>$nombre</td>";
                    echo "<td>$paterno</td>";
                    echo "<td>$materno</td>";
                    $func=nombraraparato($aparato);
                    echo "<td>$func</td>";
                    
                    // PDF Estudios
                    if(file_exists("IMGFUNCIONALES2024/Estudios/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $estudios = "IMGFUNCIONALES2024/Estudios/$id_benficiario.pdf";
                       echo <<<EOT
                        <td><button data-tooltip='Ver documento' onclick='ResponseDocEditable("Documento: Estudios", "$estudios", "CloseResponse()", "UploadDoc(\"Reemplaza tu documento: Estudios\", \"$id_benficiario\", \"Estudios\")")'><i class='bi bi-file-earmark-pdf'></i></button></td>
                        EOT;
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Estudios)', '$id_benficiario', 'Estudios')\"><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF INE
                    if(file_exists("IMGFUNCIONALES2024/INE/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $INE = "IMGFUNCIONALES2024/INE/$id_benficiario.pdf";
                        echo <<<EOT
                        <td><button data-tooltip='Ver documento' onclick='ResponseDocEditable("Documento: INE", "$INE", "CloseResponse()", "UploadDoc(\"Reemplaza tu documento: INE\", \"$id_benficiario\", \"INE\")")'><i class='bi bi-file-earmark-pdf'></i></button></td>
                        EOT;
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (INE)', '$id_benficiario', 'INE')\"><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF Identificacion del beneficiario
                    if(file_exists("IMGFUNCIONALES2024/IdBeneficiario/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $idben = "IMGFUNCIONALES2024/IdBeneficiario/$id_benficiario.pdf";
                        echo <<<EOT
                        <td><button data-tooltip='Ver documento' onclick='ResponseDocEditable("Documento: Identificacion Beneficiario", "$idben", "CloseResponse()", "UploadDoc(\"Reemplaza tu documento: Id.Beneficiario\", \"$id_benficiario\", \"IDBeneficiario\")")'><i class='bi bi-file-earmark-pdf'></i></button></td>
                        EOT;
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Identificación beneficiario)', '$id_benficiario', 'IDBeneficiario')\"><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF CURP
                    if(file_exists("IMGFUNCIONALES2024/CURP/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $curpdoc = "IMGFUNCIONALES2024/CURP/$id_benficiario.pdf";
                        echo <<<EOT
                        <td><button data-tooltip='Ver documento' onclick='ResponseDocEditable("Documento: CURP", "$curpdoc", "CloseResponse()", "UploadDoc(\"Reemplaza tu documento: CURP\", \"$id_benficiario\", \"CURP\")")'><i class='bi bi-file-earmark-pdf'></i></button></td>
                        EOT;
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (CURP)', '$id_benficiario', 'CURP')\"><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF Comprobante de domicilio
                    if(file_exists("IMGFUNCIONALES2024/Domicilio/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $domicilio = "IMGFUNCIONALES2024/Domicilio/$id_benficiario.pdf";
                        echo <<<EOT
                        <td><button data-tooltip='Ver documento' onclick='ResponseDocEditable("Documento: Comprobante de Domicilio", "$domicilio", "CloseResponse()", "UploadDoc(\"Reemplaza tu documento: Domicilio\", \"$id_benficiario\", \"Domicilio\")")'><i class='bi bi-file-earmark-pdf'></i></button></td>
                        EOT;
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Comprobante de domicilio)', '$id_benficiario', 'Domicilio')\"><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF Indicacion medica
                    if(file_exists("IMGFUNCIONALES2024/Indicacion/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $medica = "IMGFUNCIONALES2024/Indicacion/$id_benficiario.pdf";
                        echo <<<EOT
                        <td><button data-tooltip='Ver documento' onclick='ResponseDocEditable("Documento: Indicacion medica", "$medica", "CloseResponse()", "UploadDoc(\"Reemplaza tu documento: Indicación médica\", \"$id_benficiario\", \"Indicacion\")")'><i class='bi bi-file-earmark-pdf'></i></button></td>
                        EOT;
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Indicación médica)', '$id_benficiario', 'Indicacion')\"><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF Solicitud
                    if(file_exists("IMGFUNCIONALES2024/Solicitud/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $solicitud = "IMGFUNCIONALES2024/Solicitud/$id_benficiario.pdf";
                        echo <<<EOT
                        <td><button data-tooltip='Ver documento' onclick='ResponseDocEditable("Documento: Solicitud", "$solicitud", "CloseResponse()", "UploadDoc(\"Reemplaza tu documento: Solicitud\", \"$id_benficiario\", \"Solicitud\")")'><i class='bi bi-file-earmark-pdf'></i></button></td>
                        EOT;
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Solicitud)', '$id_benficiario', 'Solicitud')\"><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF Foto
                    if(file_exists("IMGFUNCIONALES2024/Foto/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $foto = "IMGFUNCIONALES2024/Foto/$id_benficiario.pdf";
                        echo <<<EOT
                        <td><button data-tooltip='Ver documento' onclick='ResponseDocEditable("Documento: Foto", "$foto", "CloseResponse()", "UploadDoc(\"Reemplaza tu documento: Foto\", \"$id_benficiario\", \"Foto\")")'><i class='bi bi-file-earmark-pdf'></i></button></td>
                        EOT;
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Foto)', '$id_benficiario', 'Foto')\"><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    // PDF Foto de Entrega
                    if(file_exists("IMGFUNCIONALES2024/FotoEntrega/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $fotoE = "IMGFUNCIONALES2024/FotoEntrega/$id_benficiario.pdf";
                        echo <<<EOT
                        <td><button data-tooltip='Ver documento' onclick='ResponseDocEditable("Documento: Foto de Entrega", "$fotoE", "CloseResponse()", "UploadDoc(\"Reemplaza tu documento: FotoEntrega\", \"$id_benficiario\", \"FotoE\")")'><i class='bi bi-file-earmark-pdf'></i></button></td>
                        EOT;
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Foto de Entrega)', '$id_benficiario', 'FotoE')\"><i class='bi bi-cloud-upload'></i></button></td>";
                    }
 
                    // PDF Recibo
                    if(file_exists("IMGFUNCIONALES2024/Recibo/$id_benficiario.pdf")){// Si ya tiene la ruta del archivo PDF al presionar el boton mostrara el PDF en la pagina
                        $recibo = "IMGFUNCIONALES2024/Recibo/$id_benficiario.pdf";
                        echo <<<EOT
                        <td><button data-tooltip='Ver documento' onclick='ResponseDocEditable("Documento: Recibo", "$recibo", "CloseResponse()", "UploadDoc(\"Reemplaza tu documento: Recibo\", \"$id_benficiario\", \"Recibo\")")'><i class='bi bi-file-earmark-pdf'></i></button></td>
                        EOT;
                    }else{ //En caso contrario al presionar el boton le pedira que suba un PDF.
                        echo "<td><button data-tooltip='Subir documentos' onclick=\"UploadDoc('Sube tu documento PDF (Recibo)', '$id_benficiario', 'Recibo')\"><i class='bi bi-cloud-upload'></i></button></td>";
                    }

                    echo "<td><a href='editarBeneficiario.php?id=$id_benficiario'><button><i class='bi bi-pencil'></i></button></a></td>";
                    echo "<td><button data-tooltip='Eliminar registro' onclick=\"ResponseDelete($id_benficiario)\"><i class='bi bi-trash3'></i></button></td>";
                    echo "<td><button data-tooltip='Ver error' onclick='WaitDoc(\"Error\", \"$comentario\", \"CloseResponse()\")'><i class='bi bi-x-circle'></i></button></td>";

                    echo "</tr>";
                }

                
            }
        ?>
    </tbody>
</table>
</div>              
</div>
</body>
</html>

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
        "scrollCollapse": false // Colapsar tabla si no hay suficiente contenido para llenar el espacio
    });
</script>