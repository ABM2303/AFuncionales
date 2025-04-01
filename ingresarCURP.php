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
    <title>Ingresar CURP</title>
    <!-- Styles -->
    <link rel="stylesheet" href="Styles/entradasStyles.css">
</head>

<body>
    <!-- Header menu -->
    <?php include 'header.php'; ?>
    <!-- Contenido -->
    <content>
        <?php if (isset($error)) { ?>
        <div id="Errores">
            <div id="Error">
                <p><?php echo $error; ?></p>
            </div>
        </div>
        <?php } ?>

        <?php
            if ($_SESSION['rol'] != 2 && $_SESSION['rol'] != 3) {
                echo "<h1>Página no disponible.</h1>";
            }
            else{
        ?>

        <h1 class="PageTitle">Ingresar CURP (Funcionales)</h1>
        <div id="UserTitle">
            <?php if($_SESSION['rol'] == 3){?>
        <form action="handleCURP.php" method="post">
            <?php }else if($_SESSION['rol'] == 2){?>
                <form action="handleCURPmun.php" method="post">
            <?php } ?>
            <label id='CURPLabel'>CURP:</label>
            <input type='text' name='CURP' id='CURP' placeholder='CURP' required>
        <button type="submit">Enviar</button>
        </form>

        </div>
        <div class="EntradasForm">

        </div>
        <?php } ?>
    </content>
</body>

</html>
