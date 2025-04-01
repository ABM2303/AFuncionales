<?php
include 'conexion.php';
$conn = conectar();
if (empty($conn) || !($conn instanceof mysqli)) {
    $error = "⛔Error de conexión: <br>" . $conn;
}
// Verificar si se ha enviado el parámetro id
$nomostrar = 0;
if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];


    $query = $conn->prepare("SELECT * FROM usuarios WHERE id=$id_usuario");
    $query->execute();
    $query->bind_result($id, $nombre, $paterno, $materno, $usuario, $contrasena, $rol, $fecha_registro, $estado, $municipio, $ruedas, $pci, $pca, $bath, $anda, $baston, $baston4, $auditivo, $muleta, $optometrico, $diadema, $infantil, $invidente);
    $query->store_result();
    
} else {
    // Si no se proporcionó el parámetro id, puedes redirigir al usuario a otra página de error o de lista de registros
    header("Location: index.php");
    exit(); // Asegúrate de terminar la ejecución del script después de redirigir
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Include common resources -->
    <?php include 'commonResources.php'; ?>
    <title>Editar Usuario</title>
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


<!-- Contenido -->

<?php
 if ($_SESSION['rol'] != 1) {
    echo "<h1>Página no disponible.</h1>";
}
else{
?>
<h1 class="PageTitle">Control de Usuarios</h1>
<div id="ContenidoUsuarios">
    <div id="ConfiguracionesUsuario" class="OpcMenuContent">

    </div>
</div>
</body>
</html>
<?php } ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        showConfig('Registrar');
    });

    //Controla la visibilidad de los elementos de configuración
    function showConfig(target) {
        var configs = document.getElementById("ConfiguracionesUsuario");
        var buttons = document.querySelectorAll(".OpcMenuButton");

        configs.classList.add('hide'); // Oculta el elemento actual
        // Iterar sobre todos los botones y ajustar la clase activa
        buttons.forEach(button => {
            if (button.getAttribute('data-target') === target) {
                button.classList.add('active'); // Marcar el botón como activo si coincide con el target
            } else {
                button.classList.remove('active'); // Quitar la clase activa de los otros botones
            }
        });
        setTimeout(() => {
            // Cambiar el contenido según el target

            switch (target) {
                case 'Registrar':
                    configs.innerHTML =
                        `
                        <?php
                        while($query->fetch()){
                        
                        ?>
                        <h1>Modificar</h1>
                        <h3>Modificar datos del usuario</h3>
                        <hr>
                        
                        <form id="FormEditarUsuario" class="ConfiguracionesUsuariosForm">
                        <div class="FormData" style="width: 100%;">
                            <input type="hidden" name="idu" id="idu" placeholder="ID(No se va a modificar)" value="<?php echo $id_usuario ?>">
                        </div>
                        <div class="FormData" style="width: 33.3%;">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" placeholder="Nombre(s)" value="<?php echo $nombre ?>" required>
                        </div>
                        <div class="FormData" style="width: 33.3%;">
                            <label for="apellido_paterno">Apellido Paterno:</label>
                            <input type="text" name="apellido_paterno" id="apellido_paterno" placeholder="Apellido paterno" value="<?php echo $paterno ?>" required>
                        </div>
                        <div class="FormData" style="width: 33.3%;">
                            <label for="apellido_materno">Apellido Materno:</label>
                            <input type="text" name="apellido_materno" id="apellido_materno" placeholder="Apellido materno" value="<?php echo $materno ?>" required>
                        </div>
                        <div class="FormData" style="width: 50%;">
                            <label for="rol">Rol:</label>
                            <select name="rol" id="rol">
                                <?php
                        $sql = "SELECT id_rol, nombre FROM roles";
                        $result = $conn->query($sql);
                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                if($rol == $row['id_rol']){
                                    echo "<option value='" . $row['id_rol'] . "' selected>" . $row['nombre'] . "</option>";
                                }else{
                                    echo "<option value='" . $row['id_rol'] . "'>" . $row['nombre'] . "</option>";
                                }
                                
                            }
                        }
                        ?>
                            </select>
                        </div>

                        <div class="FormData" style="width: 50%;">
                            <label for="estado">Estado:</label>
                            <select name="estado" id="estado">
                            <?php 
                                if($estado=="ACTIVO"){
                                    echo "<option value='ACTIVO' selected>ACTIVO</option>";
                                    echo "<option value='INACTIVO'>INACTIVO</option>";
                                }else{
                                    echo "<option value='ACTIVO'>ACTIVO</option>";
                                    echo "<option value='INACTIVO' selected>INACTIVO</option>";
                                }
                            ?>
                            </select>
                        </div>

                       <div class="FormData" style="width: 50%;">
                        <label for="municipio">Municipio:</label>
                            <select name="municipio" id="municipio">
                                    <?php
                            $sql = "SELECT DISTINCT CVE_MUN, NOM_MUN FROM cat_mun_loc;";
                            $result = $conn->query($sql);
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    if($municipio == $row['CVE_MUN']){
                                        echo "<option value='" . $row['CVE_MUN'] . "' selected>" . $row['NOM_MUN'] . "</option>";
                                    }else{
                                        echo "<option value='" . $row['CVE_MUN'] . "'>" . $row['NOM_MUN'] . "</option>";
                                    }
                                    
                                }
                            }
                            $conn->close();
                            ?>
                            </select>
                        </div>

                        <div class="FormData">
                            
                        </div>

                        <div class="FormData" style="width: 50%;">
                            <label for="usuario">Usuario:</label>
                            <input type="text" name="usuario" id="usuario" placeholder="Usuario (para inicio de sesión)" value="<?php echo $usuario ?>" required>
                        </div>
                        <div class="FormData" style="width: 50%;">
                            <label for="contrasena">Contraseña:</label>
                            <input type="password" name="contrasena" id="contrasena" placeholder="Contraseña">
                        </div>
                        <h3>Asignacion de aparatos funcionales</h3>
                        <hr>
                        <div class="FormData" style="width: 50%;">
                            <label for="ruedas">Silla de ruedas:</label>
                            <input type="number" name="ruedas" id="ruedas" min="0" value="<?php echo $ruedas ?>" required>
                        </div>
                        <div class="FormData" style="width: 50%;">
                            <label for="sillapci">Silla PCI:</label>
                            <input type="number" name="sillapci" id="sillapci" min="0" value="<?php echo $pci ?>"required>
                        </div>
                        <div class="FormData" style="width: 50%;">
                            <label for="sillapca">Silla PCA:</label>
                            <input type="number" name="sillapca" id="sillapca" min="0" value="<?php echo $pca ?>"required>
                        </div>
                        <div class="FormData" style="width: 50%;">
                            <label for="sillabath">Silla Baño:</label>
                            <input type="number" name="sillabath" id="sillabath" min="0" value="<?php echo $bath ?>" required>
                        </div>
                        <div class="FormData" style="width: 50%;">
                            <label for="andadera">Andadera:</label>
                            <input type="number" name="andadera" id="andadera" min="0" value="<?php echo $anda ?>" required>
                        </div>
                        <div class="FormData" style="width: 50%;">
                            <label for="baston">Baston:</label>
                            <input type="number" name="baston" id="baston" min="0" value="<?php echo $baston ?>" required>
                        </div>
                        <div class="FormData" style="width: 50%;">
                            <label for="baston4">Baston 4 puntos:</label>
                            <input type="number" name="baston4" id="baston4" min="0" value="<?php echo $baston4 ?>" required>
                        </div>
                        
                        <div class="FormData" style="width: 50%;">
                            <label for="auditivo">Aparato Auditivo:</label>
                            <input type="number" name="auditivo" id="auditivo" min="0" value="<?php echo $auditivo ?>" required>
                        </div>

                        <div class="FormData" style="width: 50%;">
                            <label for="muleta">Muletas:</label>
                            <input type="number" name="muleta" id="muleta" min="0"  value="<?php echo $muleta ?>"required>
                        </div>

                        <div class="FormData" style="width: 50%;">
                            <label for="optometrico">Optométricos:</label>
                            <input type="number" name="optometrico" id="optometrico" min="0"  value="<?php echo $optometrico ?>" required>
                        </div>

                        <div class="FormData" style="width: 50%;">
                            <label for="diadema">Aparatos Auditivos (Diadema):</label>
                            <input type="number" name="diadema" id="diadema" min="0" value="<?php echo $diadema ?>" required>
                        </div>

                        <div class="FormData" style="width: 50%;">
                            <label for="ruedasinfantil">Sillas de ruedas (Infantil):</label>
                            <input type="number" name="ruedasinfantil" id="ruedasinfantil" min="0" value="<?php echo $infantil ?>" required>
                        </div>

                        <div class="FormData" style="width: 50%;">
                            <label for="invidente">Baston plegable para invidente:</label>
                            <input type="number" name="invidente" id="invidente" min="0" value="<?php echo $invidente ?>" required>
                        </div>

                        <div class="FormData" style="width: 100%;">
                            <button type="submit">
                                <i class="bi bi-floppy"></i>
                                <span>Guardar cambios</span>
                            </button>
                        </div>
                        <?php }?>
                        `;
                    // Enviar el formulario de registro de usuarios
                    $('#FormEditarUsuario').submit(function (e) {
                        e.preventDefault();
                        var formData = new FormData(this);
                        formData.append('accion', 'modificarUsuario');
                        $.ajax({
                            url: 'handleControlUsuarios.php',
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            beforeSend: function () {
                                WaitDoc('Modificando usuario', 'Por favor espere un momento', 'location.reload()');
                            },
                            success: function (response) {
                                console.log(response);
                                if (response === 'Success') {
                                    WaitDoc('Usuario modificado', 'El usuario se modificó correctamente', 'location.reload()');
                                } else {
                                    WaitDoc('Error al modificar', 'Ocurrió un error al modificar el usuario, intente poner otro nombre de usuario.', 'CloseResponse()');
                                }
                            },
                            error: function () {
                                WaitDoc('Error al modificar', 'Ocurrió un error al enviar los datos para la modificación del usuario', 'CloseResponse()');
                            }
                        });
                    });
                    break;
                default:
                    configs.innerHTML = ""; // Limpiar el contenido si no se encuentra el target
                    break;
            }

            configs.classList.remove('hide'); // Muestra el elemento nuevamente
        }, 500); // Espera a que la transición termine
    }

    showConfig('Registrar'); // Mostrar la configuración por defecto al cargar la página
</script>