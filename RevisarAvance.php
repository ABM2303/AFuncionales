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
    <title>Avance</title>
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
<!-- Tabla de usuarios -->
<table id='tablaUsuarios'>
    <thead>
        <tr>
            <th>Aparato</th>
            <th>Asignados</th>
            <th>Capturados</th>
            <th>Porcentaje de avance</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $conn = conectar();
            $query = $conn->prepare("SELECT silla_ruedas, sillapci, sillapca, sillabath, andadera, baston, baston4, auditivo, muleta, optometrico, diadema, ruedas_infantil, baston_invidente FROM usuarios WHERE id =".$_SESSION['id']);
            $query->execute();
            $query->bind_result($ruedas, $pci, $pca, $bath, $andadera, $baston, $baston4, $auditivo, $muletas, $optometrico, $diadema, $rinfantil, $invidente);
            $query->store_result();
            if($query->fetch()){
                    echo "<tr>";
                    echo "<td>Silla de Ruedas</td>";
                    echo "<td>$ruedas</td>";
                    $query1 = $conn->prepare("SELECT COUNT(aparato) FROM beneficiario WHERE aparato='Ruedas' AND id_usuario=".$_SESSION['id']);
                    $query1->execute();
                    $query1->bind_result($usados);
                    $query1->store_result();
                    if($query1->fetch()){
                        $porcentaje = 0;
                        echo "<td>$usados</td>";
                        if($ruedas > 0){
                            $porcentaje= ($usados/$ruedas)*100;
                        }
                        echo "<td>$porcentaje%</td>";
                    }
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Silla PCI</td>";
                    echo "<td>$pci</td>";
                    $query2 = $conn->prepare("SELECT COUNT(aparato) FROM beneficiario WHERE aparato='PCI' AND id_usuario=".$_SESSION['id']);
                    $query2->execute();
                    $query2->bind_result($usados);
                    $query2->store_result();
                    if($query2->fetch()){
                        $porcentaje = 0;
                        echo "<td>$usados</td>";
                        if($pci > 0){
                            $porcentaje= ($usados/$pci)*100;
                        }
                        echo "<td>$porcentaje%</td>";
                    }
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Silla PCA</td>";
                    echo "<td>$pca</td>";
                    $query3 = $conn->prepare("SELECT COUNT(aparato) FROM beneficiario WHERE aparato='PCA' AND id_usuario=".$_SESSION['id']);
                    $query3->execute();
                    $query3->bind_result($usados);
                    $query3->store_result();
                    if($query3->fetch()){
                        $porcentaje = 0;
                        echo "<td>$usados</td>";
                        if($pca > 0){
                            $porcentaje= ($usados/$pca)*100;
                        }
                        echo "<td>$porcentaje%</td>";
                    }
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Silla Baño</td>";
                    echo "<td>$bath</td>";
                    $query4 = $conn->prepare("SELECT COUNT(aparato) FROM beneficiario WHERE aparato='Bath' AND id_usuario=".$_SESSION['id']);
                    $query4->execute();
                    $query4->bind_result($usados);
                    $query4->store_result();
                    if($query4->fetch()){
                        $porcentaje = 0;
                        echo "<td>$usados</td>";
                        if($bath > 0){
                            $porcentaje= ($usados/$bath)*100;
                        }
                        echo "<td>$porcentaje%</td>";
                    }
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Andadera</td>";
                    echo "<td>$andadera</td>";
                    $query5 = $conn->prepare("SELECT COUNT(aparato) FROM beneficiario WHERE aparato='Andadera' AND id_usuario=".$_SESSION['id']);
                    $query5->execute();
                    $query5->bind_result($usados);
                    $query5->store_result();
                    if($query5->fetch()){
                        $porcentaje = 0;
                        echo "<td>$usados</td>";
                        if($andadera > 0){
                            $porcentaje= ($usados/$andadera)*100;
                        }
                        echo "<td>$porcentaje%</td>";
                    }
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Baston</td>";
                    echo "<td>$baston</td>";
                    $query6 = $conn->prepare("SELECT COUNT(aparato) FROM beneficiario WHERE aparato='Baston' AND id_usuario=".$_SESSION['id']);
                    $query6->execute();
                    $query6->bind_result($usados);
                    $query6->store_result();
                    if($query6->fetch()){
                        $porcentaje = 0;
                        echo "<td>$usados</td>";
                        if($baston > 0){
                            $porcentaje= ($usados/$baston)*100;
                        }
                        echo "<td>$porcentaje%</td>";
                    }
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Baston de 4 puntos</td>";
                    echo "<td>$baston4</td>";
                    $query7 = $conn->prepare("SELECT COUNT(aparato) FROM beneficiario WHERE aparato='Baston4' AND id_usuario=".$_SESSION['id']);
                    $query7->execute();
                    $query7->bind_result($usados);
                    $query7->store_result();
                    if($query7->fetch()){
                        echo "<td>$usados</td>";
                        $porcentaje = 0;
                        if($baston4 > 0){
                            $porcentaje= ($usados/$baston4)*100;
                        }
                        echo "<td>$porcentaje%</td>";
                    }
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Aparatos Auditivos</td>";
                    echo "<td>$auditivo</td>";
                    $query8 = $conn->prepare("SELECT COUNT(aparato) FROM beneficiario WHERE aparato='Auditivo' AND id_usuario=".$_SESSION['id']);
                    $query8->execute();
                    $query8->bind_result($usados);
                    $query8->store_result();
                    if($query8->fetch()){
                        echo "<td>$usados</td>";
                        $porcentaje = 0;
                        if($auditivo > 0){
                            $porcentaje = ($usados/$auditivo)*100;
                        }
                        echo "<td>$porcentaje%</td>";
                    }
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Muletas</td>";
                    echo "<td>$muletas</td>";
                    $query9 = $conn->prepare("SELECT COUNT(aparato) FROM beneficiario WHERE aparato='Muletas' AND id_usuario=".$_SESSION['id']);
                    $query9->execute();
                    $query9->bind_result($usados);
                    $query9->store_result();
                    if($query9->fetch()){
                        echo "<td>$usados</td>";
                        $porcentaje = 0;
                        if($muletas > 0){
                            $porcentaje= ($usados/$muletas)*100;
                        }
                        echo "<td>$porcentaje%</td>";
                    }
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Optométrico</td>";
                    echo "<td>$optometrico</td>";
                    $query9 = $conn->prepare("SELECT COUNT(aparato) FROM beneficiario WHERE aparato='Optometrico' AND id_usuario=".$_SESSION['id']);
                    $query9->execute();
                    $query9->bind_result($usados);
                    $query9->store_result();
                    if($query9->fetch()){
                        echo "<td>$usados</td>";
                        $porcentaje = 0;
                        if($optometrico > 0){
                            $porcentaje= ($usados/$optometrico)*100;
                        }
                        echo "<td>$porcentaje%</td>";
                    }
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Aparatos auditivos (Diadema)</td>";
                    echo "<td>$diadema</td>";
                    $query9 = $conn->prepare("SELECT COUNT(aparato) FROM beneficiario WHERE aparato='Diadema' AND id_usuario=".$_SESSION['id']);
                    $query9->execute();
                    $query9->bind_result($usados);
                    $query9->store_result();
                    if($query9->fetch()){
                        echo "<td>$usados</td>";
                        $porcentaje = 0;
                        if($diadema > 0){
                            $porcentaje= ($usados/$diadema)*100;
                        }
                        echo "<td>$porcentaje%</td>";
                    }
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Sillas de Ruedas (Infantil)</td>";
                    echo "<td>$rinfantil</td>";
                    $query9 = $conn->prepare("SELECT COUNT(aparato) FROM beneficiario WHERE aparato='Rinfantil' AND id_usuario=".$_SESSION['id']);
                    $query9->execute();
                    $query9->bind_result($usados);
                    $query9->store_result();
                    if($query9->fetch()){
                        echo "<td>$usados</td>";
                        $porcentaje = 0;
                        if($rinfantil > 0){
                            $porcentaje= ($usados/$rinfantil)*100;
                        }
                        echo "<td>$porcentaje%</td>";
                    }
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>Bastones para Invidentes</td>";
                    echo "<td>$invidente</td>";
                    $query9 = $conn->prepare("SELECT COUNT(aparato) FROM beneficiario WHERE aparato='BInvidente' AND id_usuario=".$_SESSION['id']);
                    $query9->execute();
                    $query9->bind_result($usados);
                    $query9->store_result();
                    if($query9->fetch()){
                        echo "<td>$usados</td>";
                        $porcentaje = 0;
                        if($invidente > 0){
                            $porcentaje= ($usados/$invidente)*100;
                        }
                        echo "<td>$porcentaje%</td>";
                    }
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
