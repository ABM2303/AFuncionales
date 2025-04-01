<?php
include 'conexion.php';
$conn = conectar();
if (empty($conn) || !($conn instanceof mysqli)) {
    $error = "⛔Error de conexión: <br>" . $conn;
}
session_start();
$_SESSION['usuario'] = NULL;
$_SESSION['LoggedIn'] = false;
$_SESSION['rol'] = NULL;

$query = $conn->prepare("UPDATE bitacora_sesiones SET fecha_cierre = NOW() WHERE id_bitacora_sesiones = ?");
$query->bind_param("i", $_SESSION['id_sesion']);
if($query->execute()){
    $query->execute();
    $query->close();
    $_SESSION['id_sesion'] = NULL;
}

session_unset();
session_destroy();
header('Location: login.php');
?>