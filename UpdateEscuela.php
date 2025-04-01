<?php
include 'conexion.php';
$conn = conectar();
if (empty($conn) || !($conn instanceof mysqli)) {
    $error = "⛔Error de conexión: <br>" . $conn;
}


if(isset($_POST['submit'])){

    $contrasena=$_POST['contrasena-'];

      //insert en la tabla usuarios

      $query= $conn->prepare("INSERT INTO escuelas (clave_esc, nom_esc, zona_esc, sector_esc, equipo, turno, huerto, enc_huerto, Id_Niv_Esc, num_mujeres, num_hombres, espacio, comedor, comite, Id_Cat_Tip_Via, nombre_vial, numero, c_postal, nombre_asen, tipo_asen, localidad, referencia) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
      $query->bind_param("sssssssssiiississsssss", $clave, $nombre, $zona, $sector, $equipos, $turno, $huerto, $encargado, $nivel, $mujeres, $hombres, $espacio, $comedor, $comite, $tipovial, $nombrevial, $numero, $CP, $nombreasen, $tipo_asen, $localidad, $referencia);
        if($query->execute()){
            $error = "✅ Ingresado correctamente";
        } else {
            $error = "⛔ Error al guardar en la base de datos";
        }
    //   $insert= mysqli_query($conn,$query) or die(mysqli_error());
    
  }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Include common resources -->
    <?php include 'commonResources.php'; ?>
    <title>Usuarios</title>
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




<!-- Contenido -->
<h1 class="PageTitle">Control de Usuarios</h1>
<div id="ContenidoUsuarios">
    <div id="MenuUsuarios">
        <div class="OpcMenu">
            <a href="controlUsuarios.php" class="OpcMenuButton" data-target="Registrar" onclick="showConfig('Registrar')">Registro</a>
            <hr>
            <a class="OpcMenuButton active" data-target="Modificar" onclick="showConfig('Modificar')">Modificar</a>
        </div>
    </div>
    <div id="ConfiguracionesUsuario" class="OpcMenuContent">
    <h1>Modificar</h1>
        <h3>Modificar usuarios existentes</h3>
        <hr>
        <table id='tablaUsuarios'>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Asignación</th>
                <th>Modificar</th>
            </tr>
        </thead>
            <tbody>
                <?php
                    $conn = conectar();
                    $query = $conn->prepare("SELECT id, nombre_esc  FROM escuelas");
                    $query->execute();
                    $query->bind_result($id_usuario, $nombre, $usuario);
                    $query->store_result();
                    while($query->fetch()){
                        echo "<tr>";
                        echo "<td>$id_usuario</td>";
                        echo "<td>$nombre</td>";
                        echo "<td>$usuario</td>";
                        echo "<td><input style='width: 100%;' type='number' placeholder='Nueva asignación' id='contrasena-$id_usuario' required></td>";
                        echo "<td><button onclick='ModificarUsuario($id_usuario)'><i class='bi bi-pencil'></i></button></td>";
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
    // Envia la modificación de la contraseña
    function ModificarUsuario(id) {
        var idCampoContrasena = `#contrasena-${id}`;
        var contrasena = document.querySelector(idCampoContrasena).value;

        
        console.log(contrasena);
        $.ajax({
            url: 'handleControlUsuarios.php',
            type: 'POST',
            data: {
                accion: 'modificarUsuario',
                id: id,
                contrasena: contrasena
            },
            success: function(response) {
                if (response === 'Success') {
                    alert("Usuario con id: "+id+" ha sido modificado correctamente ✅.");
                } else {
                    alert("Ocurrió un error al modificar la asignacion del usuario ⛔, intente mas tarde.");
                }
            },
            error: function() {
                alert("Ocurrió un error al enviar los datos para modificar la contraseña del usuario ⛔, intente mas tarde");
            }
        });
    }

    showConfig('Registrar'); // Mostrar la configuración por defecto al cargar la página
</script>