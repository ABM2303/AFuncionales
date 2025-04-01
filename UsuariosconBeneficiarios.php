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
    <title>Usuarios con beneficiarios</title>
    <!-- Styles -->
    <link rel="stylesheet" href="Styles/entradasStyles.css">
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

<h1 class="PageTitle">Buscar Beneficiarios (Aparatos Funcionales)</h1>

<!-- Formulario de registro de dotaciones -->
<form id="registroDotaciones" method="post" action="cambiausuarios.php">
    <div id="registroDotacionesInputs">

        <div class="FormData" style="width: 33.3%;">
            <label for="usuario">Usuario:</label>
            <select name="usuario" id="usuario">
            <option hidden selected>Selecciona una opción</option>
                    <?php
            $sql = "SELECT id, usuario FROM usuarios;";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    echo "<option value='" . $row['id'] . "'>" . $row['usuario'] . "</option>";
                }
            }
            
            ?>
            </select>
        </div>
        <button type="submit"><i class='bi bi-search'></i></button>
        <?php include 'ventanaResponse.php'; ?>
        </form>
        <div class="EntradasForm" style="width: 197%;">

        </div>

        </body>
        </html>