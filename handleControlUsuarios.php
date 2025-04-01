<?php
session_start();
include 'conexion.php';
$conn = conectar();
if (empty($conn) || !($conn instanceof mysqli)) {
    $error = "⛔Error de conexión: <br>" . $conn;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['accion'] == 'registrarUsuario') {
        $nombre=$_POST['nombre'];
        $apellido_paterno=$_POST['apellido_paterno'];
        $apellido_materno=$_POST['apellido_materno'];
        $usuario=$_POST['usuario'];
        $contrasena=$_POST['contrasena'];
        $id_rol=$_POST['rol'];
        $estado=$_POST['estado'];
        $municipio=$_POST['municipio'];
        $ruedas=$_POST['ruedas'];
        $sillapci=$_POST['sillapci'];
        $sillapca=$_POST['sillapca'];
        $sillabath=$_POST['sillabath'];
        $andadera=$_POST['andadera'];
        $baston=$_POST['baston'];
        $baston4=$_POST['baston4'];
        $auditivo=$_POST['auditivo'];
        $muleta=$_POST['muleta'];
        $optometrico=$_POST['optometrico'];
        $diadema=$_POST['diadema'];
        $ruedasinfantil=$_POST['ruedasinfantil'];
        $invidente=$_POST['invidente'];


        $hash = password_hash($contrasena, PASSWORD_BCRYPT);
        $query = $conn->prepare("INSERT INTO usuarios (nombres, apellido_paterno, apellido_materno, usuario, contrasena, id_rol, fecha_registro, estado, clave_municipio, silla_ruedas, sillapci, sillapca, sillabath, andadera, baston, baston4, auditivo, muleta, optometrico, diadema, ruedas_infantil, baston_invidente) VALUES (?, ?, ?, ?, ?, ?, NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $query->bind_param("sssssisiiiiiiiiiiiiii", $nombre, $apellido_paterno, $apellido_materno, $usuario, $hash, $id_rol, $estado, $municipio, $ruedas, $sillapci, $sillapca, $sillabath, $andadera, $baston, $baston4, $auditivo, $muleta, $optometrico, $diadema, $ruedasinfantil, $invidente);
        if($query->execute()){
            echo "Success";
        } else {
            echo "Error: " . $query . "<br>" . $query->error;
        }
    }
    else if ($_POST['accion'] == 'modificarUsuario') {
        $idu=$_POST['idu'];
        $nombre=$_POST['nombre'];
        $apellido_paterno=$_POST['apellido_paterno'];
        $apellido_materno=$_POST['apellido_materno'];
        $usuario=$_POST['usuario'];
        $contrasena=$_POST['contrasena'];
        $id_rol=$_POST['rol'];
        $estado=$_POST['estado'];
        $municipio=$_POST['municipio'];
        $ruedas=$_POST['ruedas'];
        $sillapci=$_POST['sillapci'];
        $sillapca=$_POST['sillapca'];
        $sillabath=$_POST['sillabath'];
        $andadera=$_POST['andadera'];
        $baston=$_POST['baston'];
        $baston4=$_POST['baston4'];
        $auditivo=$_POST['auditivo'];
        $muleta=$_POST['muleta'];
        $optometrico=$_POST['optometrico'];

        $diadema=$_POST['diadema'];
        $ruedasinfantil=$_POST['ruedasinfantil'];
        $invidente=$_POST['invidente'];

        if($contrasena == NULL){
            $query = $conn->prepare("UPDATE usuarios SET nombres = ?, apellido_paterno = ?, apellido_materno = ?, usuario = ?, id_rol = ?, estado = ?, clave_municipio = ?, silla_ruedas= ?, sillapci = ?, sillapca = ?, sillabath = ?, andadera = ?, baston = ?, baston4 = ?, auditivo = ?, muleta = ?, optometrico = ?, diadema = ?, ruedas_infantil = ?, baston_invidente = ?  WHERE id = ?");
            $query->bind_param("ssssisiiiiiiiiiiiiiii", $nombre, $apellido_paterno, $apellido_materno, $usuario, $id_rol, $estado, $municipio, $ruedas, $sillapci, $sillapca, $sillabath, $andadera, $baston, $baston4, $auditivo, $muleta, $optometrico, $diadema, $ruedasinfantil, $invidente, $idu);
        }else{
            $hash = password_hash($contrasena, PASSWORD_BCRYPT);
            $query = $conn->prepare("UPDATE usuarios SET nombres = ?, apellido_paterno = ?, apellido_materno = ?, usuario = ?, contrasena = ?, id_rol = ?, estado = ?, clave_municipio = ?, silla_ruedas= ?, sillapci = ?, sillapca = ?, sillabath = ?, andadera = ?, baston = ?, baston4 = ?, auditivo = ?, muleta=?, optometrico = ?, diadema = ?, ruedas_infantil = ?, baston_invidente = ? WHERE id = ?");
            $query->bind_param("sssssisiiiiiiiiiiiiiii", $nombre, $apellido_paterno, $apellido_materno, $usuario, $hash, $id_rol, $estado, $municipio, $ruedas, $sillapci, $sillapca, $sillabath, $andadera, $baston, $baston4, $auditivo,  $muleta, $optometrico, $diadema, $ruedasinfantil, $invidente, $idu);
        }

        
        if($query->execute()){
            echo "Success";
        } else {
            echo "Error: " . $query . "<br>" . $query->error;
        }
    }
}