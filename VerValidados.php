<?php
include 'conexion.php';
$conn = conectar();
if (empty($conn) || !($conn instanceof mysqli)) {
    $error = "⛔Error de conexión: <br>" . $conn;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Include common resources -->
    <?php include 'commonResources.php'; ?>
    <title>Validados</title>
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

<h1 class="PageTitle">Lista de Beneficiarios Validados</h1>
<div id="ContenidoUsuarios">
<div id="ConfiguracionesUsuario" class="OpcMenuContent">
<h1>Beneficiarios</h1>
<h3>Beneficiarios Validados</h3>
<hr>
<!-- Tabla de usuarios -->
<table id='tablaUsuarios'>
    <thead>
        <tr>
            <th>ID</th>
            <th>CURP</th>
            <th>Nombre(s)</th>
            <th>Apellido paterno</th>
            <th>Apellido materno</th>
            <th>Genero</th>
            <th>Fecha de Nacimiento</th>
            <th>Estado de Nacimiento</th>
            <th>Estado Civil</th>
            <th>Discapacidad</th>
            <th>Aparato</th>
            <th>Poblacion</th>
            <th>Tipo de vialidad</th>
            <th>Nombre de vialidad</th>
            <th>No. Exterior</th>
            <th>Letra Exterior</th>
            <th>No. Interior</th>
            <th>Letra Interior</th>
            <th>Tipo de asentamiento</th>
            <th>Nombre de asentamiento</th>            
            <th>Referencia</th>
            <th>Celular</th>
            <th>Usuario</th>
            <th>Supervisor</th>
            <th>Municipio</th>
            <th>Clave de Localidad</th>
            <th>Localidad</th>
            <th>Código Postal</th>
            <th>Fecha de Registro</th>
            <th>Fecha de Validacion</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $conn = conectar();
            $query = $conn->prepare("SELECT id_beneficiario, curp, nombres, paterno, materno, genero, fecha_nacimiento, estado_civil, discapacidad, aparato, poblacion, Id_Cat_Tip_Via, nombre_vial, numero_ext, letra_ext, numero_int, letra_int, nombre_asen, tipo_asen, referencia, celular, CVE_MUN, localidad, c_postal, id_usuario, id_supervisor, fecha_registro, fecha_validacion, clave_localidad, estado_nacimiento FROM beneficiario WHERE  validado ='Si'");
            $query->execute();
            $query->bind_result($id_benficiario, $curp, $nombre, $paterno, $materno, $genero, $fechnac, $estcivil, $discapacidad, $aparato, $poblacion, $tipovia, $nombrevia, $numext, $letraext, $numint, $letraint, $nombreasen, $tipoasen, $referencia, $celular, $municipio, $localidad, $CP, $id_usuario, $id_supervisor, $registro, $validacion, $cvelocalidad, $entidad);
            $query->store_result();
            while($query->fetch()){
                echo "<tr>";
                echo "<td>$id_benficiario</td>";
                echo "<td>$curp</td>";
                echo "<td>$nombre</td>";
                echo "<td>$paterno</td>";
                echo "<td>$materno</td>";
                echo "<td>$genero</td>";
                echo "<td>$fechnac</td>";
                echo "<td>$entidad</td>";
                echo "<td>$estcivil</td>";
                echo "<td>$discapacidad</td>";
                $especifico=$aparato;
                switch ($aparato){
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
                        $especifico="Bastón";
                    break;
                    case 'Baston4':
                        $especifico="Bastón de 4 Puntas";
                    break;
                    case 'Auditivo':
                        $especifico="Aparato auditivo";
                    break;
                    case 'Muletas':
                        $especifico="Muletas";
                    break;
                    case 'Optometrico':
                        $especifico="Optométrico";
                    break;
                    case 'Diadema':
                        $especifico="Aparato auditivo (Diadema)";
                    break;
                    case 'Rinfantil':
                        $especifico="Sillas de Ruedas (Infantil)";
                    break;
                    case 'BInvidente':
                        $especifico="Bastones para Invidentes";
                    break;
                }
                echo "<td>$especifico</td>";
                echo "<td>$poblacion</td>";
                // Para mostrar el nombre de tipo de vialidad
                $query2 = $conn->prepare("SELECT Des_Cat_Tip_Via FROM cat_tip_via WHERE  Id_Cat_Tip_Via = $tipovia");
                $query2->execute();
                $query2->bind_result($tiponomvia);
                $query2->store_result();
                while($query2->fetch()){
                    echo "<td>$tiponomvia</td>";
                }
                echo "<td>$nombrevia</td>";
                echo "<td>$numext</td>";
                echo "<td>$letraext</td>";
                echo "<td>$numint</td>";
                echo "<td>$letraint</td>";
                echo "<td>$tipoasen</td>";
                echo "<td>$nombreasen</td>";
                echo "<td>$referencia</td>";
                echo "<td>$celular</td>";
                // Para mostrar el nombre del usuario
                $query4 = $conn->prepare("SELECT usuario FROM usuarios WHERE id = $id_usuario");
                $query4->execute();
                $query4->bind_result($usuario);
                $query4->store_result();
                while($query4->fetch()){
                    echo "<td>$usuario</td>";
                }

                // Para mostrar el nombre del usuario
                $query5 = $conn->prepare("SELECT usuario FROM usuarios WHERE id = $id_supervisor");
                $query5->execute();
                $query5->bind_result($supervisor);
                $query5->store_result();
                while($query5->fetch()){
                    echo "<td>$supervisor</td>";
                }

                // Para mostrar el nombre del municipio
                $query3 = $conn->prepare("SELECT DISTINCT NOM_MUN FROM cat_mun_loc WHERE  CVE_MUN = $municipio");
                $query3->execute();
                $query3->bind_result($nommun);
                $query3->store_result();
                while($query3->fetch()){
                    echo "<td>$nommun</td>";
                }
                echo "<td>$cvelocalidad</td>";
                echo "<td>$localidad</td>";
                echo "<td>$CP</td>";
                echo "<td>$registro</td>";
                echo "<td>$validacion</td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>
</div>              
</div>
</body>
</html>

<script>

$(document).ready(function() {
            $('#tablaUsuarios').DataTable({
                dom: 'Bfrtip', // Para que funcioncione el boton para generar el excel
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'Exportar a Excel', // Texto del botón
                        className: 'btn btn-primary' // Clase de estilo para el botón (opcional)
                    }
                ],
                language: {
                    lengthMenu: "Mostrar _MENU_ beneficiarios por página",
                    zeroRecords: "No se encontraron beneficiarios",
                    info: "Mostrando página _PAGE_ de _PAGES_",
                    infoEmpty: "No se encontraron beneficiarios con esos criterios",
                    infoFiltered: "(filtrado de _MAX_ beneficiarios totales)",
                    search: "Buscar:",
                    paginate: {
                        first: "<i class='bi bi-chevron-double-left'></i>",
                        last: "<i class='bi bi-chevron-double-right'></i>",
                        next: "<i class='bi bi-chevron-right'></i>",
                        previous: "<i class='bi bi-chevron-left'></i>"
                    }
                },
                order: [
                    [0, "asc"]
                ],
                columnDefs: [{
                    targets: [3],
                    orderable: false
                }],
                scrollX: false, // Activar scrollbar horizontal
                scrollCollapse: true // Colapsar tabla si no hay suficiente contenido para llenar el espacio
            });
        });

</script>
