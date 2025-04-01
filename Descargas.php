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
    <title>Descargar documentos</title>
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


        <h1 class='sinacceso'>Descargas Documentos</h1>
        <br><br>
        <div id="UserTitle">
        <a href='1-SOLICITUD DE APOYO.docx'><button>1.SOLICITUD DE APOYO.docx</button></a>
        <br><br>
        <a href='2-ESTUDIO SOCIECONOMICO.xlsx'><button>2.ESTUDIO SOCIOECONOMICO.xlsx</button></a>
        <br><br>
        <a href='3-RECIBO DE ENTREGA.docx'><button>3.RECIBO DE ENTREGA.docx</button></a>
        <br><br>
        </div>
        <div class="EntradasForm">

        </div>
    </content>
</body>

</html>