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
    <div id="MenuUsuarios">
        <div class="OpcMenu">
            <a class="OpcMenuButton active" data-target="Registrar" onclick="showConfig('Registrar')">Registro</a>
            <hr>
            <a class="OpcMenuButton" data-target="Modificar" onclick="showConfig('Modificar')">Modificar</a>
        </div>
    </div>
    <div id="ConfiguracionesUsuario" class="OpcMenuContent">

    </div>
</div>
</body>
</html>
<?php }?>
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
                        <h1>Registro</h1>
                        <h3>Registro de nuevos usuarios</h3>
                        <hr>
                        <form id="FormRegistroUsuario" class="ConfiguracionesUsuariosForm">
                        <div class="FormData" style="width: 33.3%;">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" placeholder="Nombre(s)" required>
                        </div>
                        <div class="FormData" style="width: 33.3%;">
                            <label for="apellido_paterno">Apellido Paterno:</label>
                            <input type="text" name="apellido_paterno" id="apellido_paterno" placeholder="Apellido paterno" required>
                        </div>
                        <div class="FormData" style="width: 33.3%;">
                            <label for="apellido_materno">Apellido Materno:</label>
                            <input type="text" name="apellido_materno" id="apellido_materno" placeholder="Apellido materno" required>
                        </div>
                        <div class="FormData" style="width: 50%;">
                            <label for="rol">Rol:</label>
                            <select name="rol" id="rol">
                                <?php
                        $sql = "SELECT id_rol, nombre FROM roles";
                        $result = $conn->query($sql);
                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                echo "<option value='" . $row['id_rol'] . "'>" . $row['nombre'] . "</option>";
                            }
                        }
                        ?>
                            </select>
                        </div>

                        <div class="FormData" style="width: 50%;">
                            <label for="estado">Estado:</label>
                            <select name="estado" id="estado">
                            <option value="ACTIVO">ACTIVO</option>
                            <option value="INACTIVO">INACTIVO</option>
                            </select>
                        </div>

                       <div class="FormData" style="width: 100%;">
                        <label for="municipio">Municipio:</label>
                            <select name="municipio" id="municipio">
                                    <?php
                            $sql = "SELECT DISTINCT CVE_MUN, NOM_MUN FROM cat_mun_loc;";
                            $result = $conn->query($sql);
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    echo "<option value='" . $row['CVE_MUN'] . "'>" . $row['NOM_MUN'] . "</option>";
                                }
                            }
                            $conn->close();
                            ?>
                            </select>
                        </div>

                        <div class="FormData">
                            
                        </div>

                        
                        <div class="FormData" style="width: 33.3%;">
                            <label for="usuario">Usuario:</label>
                            <input type="text" name="usuario" id="usuario" placeholder="Usuario (para inicio de sesión)" required>
                        </div>
                        <div class="FormData" style="width: 33.3%;">
                            <label for="contrasena">Contraseña:</label>
                            <input type="password" name="contrasena" id="contrasena" placeholder="Contraseña" required>
                        </div>
                        <div class="FormData" style="width: 33.3%;"></div>
                        <br><br>
                        <div class="FormData" style="width: 100%;">
                        <h1>Asignacion de aparatos funcionales</h1>
                        </div>
                        
                        <div class="FormData" style="width: 50%;">
                            <label for="ruedas">Sillas de ruedas:</label>
                            <input type="number" name="ruedas" id="ruedas" min="0" required>
                        </div>
                        <div class="FormData" style="width: 50%;">
                            <label for="sillapci">Sillas PCI:</label>
                            <input type="number" name="sillapci" id="sillapci" min="0" required>
                        </div>
                        <div class="FormData" style="width: 50%;">
                            <label for="sillapca">Sillas PCA:</label>
                            <input type="number" name="sillapca" id="sillapca" min="0" required>
                        </div>
                        <div class="FormData" style="width: 50%;">
                            <label for="sillabath">Sillas de Baño:</label>
                            <input type="number" name="sillabath" id="sillabath" min="0" required>
                        </div>
                        <div class="FormData" style="width: 50%;">
                            <label for="andadera">Andaderas:</label>
                            <input type="number" name="andadera" id="andadera" min="0" required>
                        </div>
                        <div class="FormData" style="width: 50%;">
                            <label for="baston">Bastones:</label>
                            <input type="number" name="baston" id="baston" min="0" required>
                        </div>
                        <div class="FormData" style="width: 50%;">
                            <label for="baston4">Bastones de 4 puntos:</label>
                            <input type="number" name="baston4" id="baston4" min="0" required>
                        </div>
                        
                        <div class="FormData" style="width: 50%;">
                            <label for="auditivo">Aparatos Auditivos:</label>
                            <input type="number" name="auditivo" id="auditivo" min="0" required>
                        </div>

                        <div class="FormData" style="width: 50%;">
                            <label for="muleta">Muletas:</label>
                            <input type="number" name="muleta" id="muleta" min="0" required>
                        </div>

                        <div class="FormData" style="width: 50%;">
                            <label for="optometrico">Optométricos:</label>
                            <input type="number" name="optometrico" id="optometrico" min="0" required>
                        </div>

                        <div class="FormData" style="width: 50%;">
                            <label for="diadema">Aparatos Auditivos (Diadema):</label>
                            <input type="number" name="diadema" id="diadema" min="0" required>
                        </div>

                        <div class="FormData" style="width: 50%;">
                            <label for="ruedasinfantil">Sillas de ruedas (Infantil):</label>
                            <input type="number" name="ruedasinfantil" id="ruedasinfantil" min="0" required>
                        </div>

                        <div class="FormData" style="width: 50%;">
                            <label for="invidente">Baston plegable para invidente:</label>
                            <input type="number" name="invidente" id="invidente" min="0" required>
                        </div>

                        <div class="FormData" style="width: 100%;">
                            <button type="submit">
                                <i class="bi bi-floppy"></i>
                                <span>Registrar</span>
                            </button>
                        </div>
                        `;
                    // Enviar el formulario de registro de usuarios
                    $('#FormRegistroUsuario').submit(function (e) {
                        e.preventDefault();
                        var formData = new FormData(this);
                        formData.append('accion', 'registrarUsuario');
                        $.ajax({
                            url: 'handleControlUsuarios.php',
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            beforeSend: function () {
                                WaitDoc('Registrando usuario', 'Por favor espere un momento', 'location.reload()');
                            },
                            success: function (response) {
                                console.log(response);
                                if (response === 'Success') {
                                    WaitDoc('Usuario registrado', 'El usuario se registró correctamente', 'location.reload()');
                                } else {
                                    WaitDoc('Error al registrar', 'Ocurrió un error al registrar el usuario, intente poner otro nombre de usuario.', 'CloseResponse()');
                                }
                            },
                            error: function () {
                                WaitDoc('Error al registrar', 'Ocurrió un error al enviar los datos para el registro de usuario', 'CloseResponse()');
                            }
                        });
                    });
                    break;
                case 'Modificar':
                    configs.innerHTML =
                        `
                            <h1>Modificar</h1>
                            <h3>Modificar usuarios existentes</h3>
                            <hr>
                            <table id='tablaUsuarios'>
                                <thead>
                                    <tr>
                                        <th>Modificar</th>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Usuario</th>
                                        <th>Sillas de Ruedas</th>
                                        <th>Sillas PCI</th>
                                        <th>Sillas PCA</th>
                                        <th>Sillas de Baño</th>
                                        <th>Andadera</th>
                                        <th>Baston</th>
                                        <th>Baston de 4 Puntos</th>
                                        <th>Aparato Auditivo</th>
                                        <th>Muletas</th>
                                        <th>Optometrico</th>
                                        <th>Aparatos Auditivos (Diadema)</th>
                                        <th>Sillas de Ruedas (Infantil)</th>
                                        <th>Baston para invidente</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $conn = conectar();
                                        $query = $conn->prepare("SELECT id, CONCAT(nombres, ' ', apellido_paterno, ' ', apellido_materno) AS nombre, usuario, silla_ruedas, sillapci, sillapca, sillabath, andadera, baston, baston4, auditivo, muleta, optometrico, diadema, ruedas_infantil, baston_invidente FROM usuarios");
                                        $query->execute();
                                        $query->bind_result($id_usuario, $nombre, $usuario, $ruedas, $pci, $pca, $bath, $andadera, $baston, $baston4, $auditivo, $muleta, $optometrico, $diadema, $rinfantil, $invidente);
                                        $query->store_result();
                                        while($query->fetch()){
                                            echo "<tr>";
                                            echo "<td><a href='ModificarUsuario.php?id=$id_usuario'><button><i class='bi bi-pencil'></i></button></a></td>";
                                            echo "<td>$id_usuario</td>";
                                            echo "<td>$nombre</td>";
                                            echo "<td>$usuario</td>";
                                            echo "<td>$ruedas</td>";
                                            echo "<td>$pci</td>";
                                            echo "<td>$pca</td>";
                                            echo "<td>$bath</td>";
                                            echo "<td>$andadera</td>";
                                            echo "<td>$baston</td>";
                                            echo "<td>$baston4</td>";
                                            echo "<td>$auditivo</td>";
                                            echo "<td>$muleta</td>";
                                            echo "<td>$optometrico</td>";
                                            echo "<td>$diadema</td>";
                                            echo "<td>$rinfantil</td>";
                                            echo "<td>$invidente</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                            `;

                    // Inicializar DataTables
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
                    break;
                default:
                    configs.innerHTML = ""; // Limpiar el contenido si no se encuentra el target
                    break;
            }

            configs.classList.remove('hide'); // Muestra el elemento nuevamente
        }, 500); // Espera a que la transición termine
    }

    // Envia la modificación de la contraseña
    function ModificarUsuario(id) {
        $.ajax({
            url: 'ModificarUsuario.php',
            type: 'POST',
            data: {
                id: id
            },
            success: function(response) {
                if (response === 'Success') {
                    WaitDoc('Usuario modificado', 'La asignación del usuario se modificó correctamente', 'location.reload()');
                } else {
                    WaitDoc('Error al modificar', 'Ocurrió un error al modificar la asignación del usuario: ' + response, 'CloseResponse()');
                }
            },
            error: function() {
                WaitDoc('Error al modificar', 'Ocurrió un error al enviar los datos para modificar la asignación del usuario', 'CloseResponse()');
            }
        });
    }

    showConfig('Registrar'); // Mostrar la configuración por defecto al cargar la página
</script>