<?php
include 'conexion.php';
$conn = conectar();
if (empty($conn) || !($conn instanceof mysqli)) {
    $error = "⛔Error de conexión: <br>" . $conn;
}
// Verificar si se ha enviado el parámetro id
$nomostrar = 0;
if (isset($_GET['id'])) {
    $id_beneficiario = $_GET['id'];


    $query = $conn->prepare("SELECT curp, nombres, paterno, materno, genero, fecha_nacimiento, estado_civil, discapacidad, id_apoyo, monto, poblacion, comentario, Id_Cat_Tip_Via, nombre_vial, numero_ext, letra_ext, numero_int, letra_int, nombre_asen, tipo_asen, referencia, celular, CVE_MUN, localidad, c_postal, estado_nacimiento FROM apoyado WHERE id_apoyado=$id_beneficiario");
    $query->execute();
    $query->bind_result($curp, $nombre, $paterno, $materno, $genero, $nacimiento, $civil, $discapacidad, $apoyo, $monto, $poblacion, $comentario, $tipovia, $nomvia, $numext, $letraext, $numint, $letraint, $nomasen, $tipo_asen, $referencia, $celular, $municipio, $localidad, $cp, $entidad);
    $query->store_result();

    $query1 = $conn->prepare("SELECT id_usuario, validado FROM apoyado WHERE id_apoyado = ?");
    $query1->bind_param("i", $id_beneficiario);
    if ($query1->execute()) {
        $result = $query1->get_result();
        $row = $result->fetch_assoc();
        $id_usuario = $row['id_usuario'];
        $validado = $row['validado'];
    }
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
    <title>Editando Usuario</title>
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
 if (($_SESSION['id'] == $id_usuario || $_SESSION['rol'] == 3) && $validado == "No") { ?>
    <h1 class="PageTitle">Editar Beneficiario</h1>
    <div id="ContenidoUsuarios">
    <div id="ConfiguracionesUsuario" class="OpcMenuContent">
    <?php
        while($query->fetch()){                    
    ?>
    <h1>Modificar</h1>
    <h3>Modificar datos del Beneficiario</h3>
    <hr>

    <form id="FormEditarBeneficiario" class="ConfiguracionesUsuariosForm">

        <div class="FormData" style="width: 33.3%;">
            <input type="hidden" name="idu" id="idu" placeholder="ID Usuario" value="<?php echo $_SESSION['id'] ?>" readonly>
        </div>

        <div class="FormData" style="width: 33.3%;">
            <input type="hidden" name="idb" id="idb" placeholder="ID Beneficiario" value="<?php echo $id_beneficiario ?>" readonly>
        </div>

        <div class="FormData" style="width: 33.3%;">
            <input type="hidden" name="curp" id="curp" placeholder="CURP" value="<?php echo $curp ?>" readonly>
        </div>
        
        <div class="FormData" style="width: 33.3%;">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre" maxlength="255" value="<?php echo $nombre ?>" readonly>    
        </div>

        <div class="FormData" style="width: 33.3%;">
            <label for="paterno">Apellido paterno:</label>
            <input type="text" name="paterno" id="paterno" placeholder="Apellido paterno" maxlength="255" value="<?php echo $paterno ?>" readonly>    
        </div>

        <div class="FormData" style="width: 33.3%;">
            <label for="materno">Apellido materno:</label>
            <input type="text" name="materno" id="materno" placeholder="Apellido materno" maxlength="255" value="<?php echo $materno ?>" readonly>    
        </div>

        <div class="FormDataRadio" style="width: 33.3%;">
            <label for="genero">Sexo:</label><br>
            <input type="text" name="genero" id="genero" placeholder="sexo" maxlength="255" value="<?php echo $genero ?>" readonly>
        </div>

        <div class="FormDataRadio" style="width: 33.3%;">
            <label for="fechnac">Fecha de nacimiento:</label><br>
            <input type="text" name="fechnac" id="fechnac" placeholder="Fecha de nacimiento" maxlength="255" value="<?php echo $nacimiento ?>" readonly>
        </div>

        <div class="FormData" style="width: 33.3%;">
            <label for="entidad">Estado de nacimiento:</label>
            <input type="text" name="entidad" id="entidad" placeholder="Entidad Federativa" maxlength="255" value="<?php echo $entidad ?>" readonly>    
        </div>

        <div class="FormData" style="width: 33.3%;">
            <label for="civil">Estado Civil:</label>
            <select name="civil" id="civil">
                <?php 
                switch($civil){
                    case "Soltero":
                        echo '<option value="Soltero" selected>Soltero</option>';
                        echo '<option value="Casado">Casado</option>';
                        echo '<option value="Divorciado">Divorciado</option>';
                        echo '<option value="Viudo">Viudo</option>';
                        break;
                    case "Casado":
                        echo '<option value="Soltero">Soltero</option>';
                        echo '<option value="Casado" selected>Casado</option>';
                        echo '<option value="Divorciado">Divorciado</option>';
                        echo '<option value="Viudo">Viudo</option>';
                        break;
                    case "Divorciado":
                        echo '<option value="Soltero">Soltero</option>';
                        echo '<option value="Casado">Casado</option>';
                        echo '<option value="Divorciado" selected>Divorciado</option>';
                        echo '<option value="Viudo">Viudo</option>';
                        break;
                    case "Viudo":
                        echo '<option value="Soltero">Soltero</option>';
                        echo '<option value="Casado">Casado</option>';
                        echo '<option value="Divorciado">Divorciado</option>';
                        echo '<option value="Viudo" selected>Viudo</option>';
                        break;
                }
                
                ?>
            </select>
        </div>

        <div class="FormDataRadio" style="width: 33.3%;">
        <label for="discapacidad">Discapacidad:</label><br><br>
        <?php 
            if($discapacidad=='Si'){
                echo '<input type="radio" name="discapaz" id="discapasi" value="Si" checked="checked">';
                echo '<label for="discapasi">Si</label>';
                echo '<input type="radio" name="discapaz" id="discapano" value="No">';
                echo '<label for="discapano">No</label>';
            }else{
                echo '<input type="radio" name="discapaz" id="discapasi" value="Si">';
                echo '<label for="discapasi">Si</label>';
                echo '<input type="radio" name="discapaz" id="discapano" value="No" checked="checked">';
                echo '<label for="discapano">No</label>';
            }
        ?>
        <br><br>
        </div>

        <div class="FormData" style="width: 33.3%;">
            <label for="apoyo">Apoyo:</label>
            <select name="apoyo" id="apoyo">
                <?php 
                $sql = "SELECT id_apoyo, tipo_apoyo FROM apoyos";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        if($apoyo==$row['id_apoyo']){
                            echo "<option value='" . $row['id_apoyo'] . "' selected>" . $row['tipo_apoyo'] . "</option>";
                        }else{
                            echo "<option value='" . $row['id_apoyo'] . "'>" . $row['tipo_apoyo'] . "</option>";
                        }
                        
                    }
                }
                ?>
            </select>   
        </div>

        <div class="FormData" style="width: 33.3%;">
        <label for="monto">Monto:</label>
        <input type="number" name="monto" id="monto" placeholder="Monto" maxlength="5" min="0" value="<?php echo $monto ?>" required>
        </div>

        <div class="FormDataRadio" style="width: 100%;">
            <?php 
            switch($poblacion){
                case "Indigena":
                    echo '<label for="poblacion">Poblacion:</label><br><br>';
                    echo '<input type="radio" name="poblacion" id="poblacioni" value="Indigena" checked="checked">';
                    echo '<label for="poblacioni">Indigena</label>';
                    echo '<input type="radio" name="poblacion" id="poblaciona" value="Afromexicano">';
                    echo '<label for="poblaciona">Afromexicano</label>';
                    echo '<input type="radio" name="poblacion" id="poblaciono" value="Otros">';
                    echo '<label for="poblaciono">Otros</label>';
                    break;
                case "Afromexicano":
                    echo '<label for="poblacion">Poblacion:</label><br><br>';
                    echo '<input type="radio" name="poblacion" id="poblacioni" value="Indigena">';
                    echo '<label for="poblacioni">Indigena</label>';
                    echo '<input type="radio" name="poblacion" id="poblaciona" value="Afromexicano" checked="checked">';
                    echo '<label for="poblaciona">Afromexicano</label> ';
                    echo '<input type="radio" name="poblacion" id="poblaciono" value="Otros">';
                    echo '<label for="poblaciono">Otros</label>';
                    break;
                case "Otros":
                    echo '<label for="poblacion">Poblacion:</label><br><br>';
                    echo '<input type="radio" name="poblacion" id="poblacioni" value="Indigena">';
                    echo '<label for="poblacioni">Indigena</label>';
                    echo '<input type="radio" name="poblacion" id="poblaciona" value="Afromexicano">';
                    echo '<label for="poblaciona">Afromexicano</label>';
                    echo '<input type="radio" name="poblacion" id="poblaciono" value="Otros" checked="checked">';
                    echo '<label for="poblaciono">Otros</label>';
                    break;
            }
            
            ?>
        </div>

        
        <p></p>
        <div class="FormData" style="width: 100%;">
            <label for="comentario">Comentario</label>
            <textarea name="comentario" id="comentario" placeholder="Escriba un comentario"><?php echo $comentario ?></textarea>
        </div>

        <div class="FormData" style="width: 33.3%;"></div>
        <div class="FormData" style="width: 33.3%;">
        <h1 class="PageTitle">Domicilio</h1>
        <br>
        </div>
        <div class="FormData" style="width: 33.3%;"></div>


        <div class="FormData" style="width: 33.3%;">
        <label for="tipovial">Tipo de vialidad:</label>
        <select name="tipovial" id="tipovial">
        <?php
            $sql = "SELECT Id_Cat_Tip_Via, Des_Cat_Tip_Via FROM cat_tip_via";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    if($tipovia==$row['Id_Cat_Tip_Via']){
                        echo "<option value='" . $row['Id_Cat_Tip_Via'] . "' selected>" . $row['Des_Cat_Tip_Via'] . "</option>";
                    }else{
                        echo "<option value='" . $row['Id_Cat_Tip_Via'] . "'>" . $row['Des_Cat_Tip_Via'] . "</option>";
                    }
                    
                }
            }
        ?>
        </select>
        </div>
        
        <div class="FormData" style="width: 33.3%;">
        <label for="nombrevial">Nombre de la vialidad:</label>
        <input type="text" name="nombrevial" id="nombrevial" placeholder="Nombre de la vialidad" maxlength="255" value="<?php echo $nomvia ?>" required>
        </div>

        <div class="FormData" style="width: 33.3%;">
        <label for="numext">Numero Exterior:</label>
        <input type="number" name="numext" id="numext" placeholder="Numero Exterior" maxlength="5" min="0" value="<?php echo $numext ?>" required>
        </div>

        <div class="FormData" style="width: 33.3%;">
        <label for="letraext">Letra Exterior:</label>
        <input type="text" name="letraext" id="letraext" placeholder="Letra Exterior" maxlength="1" value="<?php echo $letraext ?>">
        </div>

        <div class="FormData" style="width: 33.3%;">
        <label for="numint">Numero Interior:</label>
        <input type="number" name="numint" id="numint" placeholder="Numero Interior" maxlength="5" min="0" value="<?php echo $numint ?>">
        </div>

        <div class="FormData" style="width: 33.3%;">
        <label for="letraint">Letra Interior:</label>
        <input type="text" name="letraint" id="letraint" placeholder="Letra Interior" maxlength="1" value="<?php echo $letraint ?>">
        </div>

        <div class="FormData" style="width: 33.3%;">
        <label for="nombreasen">Nombre de asentamiento:</label>
        <input type="text" name="nombreasen" id="nombreasen" placeholder="Nombre de asentamiento" maxlength="255"  value="<?php echo $nomasen ?>" required>
        </div>

        <div class="FormData" style="width: 33.3%;">
        <label for="tipo_asen">Tipo de asentamiento:</label>
        <select name="tipo_asen" id="tipo_asen">
        <?php
            $sql = "SELECT Des_Ase FROM cat_ase";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    if($tipo_asen == $row['Des_Ase']){
                        echo "<option value='" . $row['Des_Ase'] . "' selected>" . $row['Des_Ase'] . "</option>";
                    }else{
                        echo "<option value='" . $row['Des_Ase'] . "'>" . $row['Des_Ase'] . "</option>";
                    }
                    
                }
            }
        ?>
        </select>
        </div>

        <div class="FormData" style="width: 33.3%;">
        <label for="referencia">Referencia:</label>
        <input type="text" name="referencia" id="referencia" placeholder="Referencia" maxlength="255" value="<?php echo $referencia ?>" required>
        </div>

        <div class="FormData" style="width: 33.3%;">
        <label for="celular">Celular:</label>
        <input type="number" name="celular" id="celular" placeholder="Celular" maxlength="10" min="0" value="<?php echo $celular ?>" required>
        </div>

        
        <div class="FormData" style="width: 33.3%;">
            <label for="municipio">Municipio:</label>
            <select name="municipio" id="municipio">
                    <?php
            $sql = "SELECT DISTINCT CVE_MUN, NOM_MUN FROM cat_mun_loc;";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    if($municipio==$row['CVE_MUN']){
                        echo "<option value='" . $row['CVE_MUN'] . "' selected>" . $row['NOM_MUN'] . "</option>";
                    }else{
                        echo "<option value='" . $row['CVE_MUN'] . "'>" . $row['NOM_MUN'] . "</option>";
                    }
                    
                    }
                    }
            
                    ?>
            </select>

        </div>
        
        <div class="EntradasForm">
            <div class="FormData" style="width: 100%">
        
        <label for="localidad">Localidad:</label>
        <select name="localidad" id="localidad" required>
        <?php
            $sql = "SELECT CVE_LOC, NOM_LOC FROM cat_mun_loc WHERE CVE_MUN = ". $municipio;
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    if($localidad == $row['NOM_LOC']){
                        echo "<option value='" . $row['CVE_LOC'] . "' selected>" . $row['NOM_LOC'] . "</option>";
                    }else{
                        echo "<option value='" . $row['CVE_LOC'] . "'>" . $row['NOM_LOC'] . "</option>";
                    }  
                }
            }
        ?>
        </select>
        </div>

        
        

        <div class="FormData" style="width: 100%;">
        <label for="CP">Código Postal:</label>
        <select name="CP" id="CP">
        <?php
            $sql = "SELECT DISTINCT d_codigo FROM cp WHERE c_mnpio = ". $municipio;
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    if($cp == $row['d_codigo']){
                        echo "<option value='" . $row['d_codigo'] . "' selected>" . $row['d_codigo'] . "</option>";
                    }else{
                        echo "<option value='" . $row['d_codigo'] . "'>" . $row['d_codigo'] . "</option>";
                    }
                    
                }
            }
        ?>
        </select>
        </div>
        <div class="FormData" id="EntradasFormButtons" style="width: 100%;">
        <button type="submit" id="guardarBtn">
        <i class="bi bi-floppy"></i>
                <span>Guardar</span>
            </button>
        </div>
        </div>

        <?php } ?>
    
    <?php include 'ventanaResponse.php'; ?>
</form>

    </div>
</div>
</body>
</html>
<?php
}
else if($_SESSION['id'] == $id_usuario && $validado == "Si"){
    echo "<h1 class='sinacceso'>Este Beneficiario ya fue validado.</h1>";
    echo "<h2 class='sinacceso'>Ya no se pueden hacer cambios.</h2>";
}else{
    echo "<h1 class='sinacceso'>Página no disponible.</h1>";
}
?>



<script>
document.getElementById('municipio').addEventListener('change', function() {
    var programa = document.getElementById('municipio').value;
    // Send the value to the server
    $.ajax({
        url: 'editarmunicipioApoyo.php',
        type: 'POST',
        data: {
            data: programa
        },
        success: function(response) {
            // You can use the response here
            $(".EntradasForm").html(response);
        },
        error: function(response) {
            console.log("response error:");
            console.log(response);
        }
    });

});

$('#FormEditarBeneficiario').submit(function (e) {
    e.preventDefault();
    var formData = new FormData(this);
    formData.append('accion', 'modificarUsuario');
        $.ajax({
                url: 'handleApoyados.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    WaitDoc('Modificando Usuario', 'Por favor espere un momento', 'location.reload()');
                },
                success: function (response) {
                    console.log(response);
                    if (response === 'Success') {
                        WaitDoc('Beneficiario modificado', 'El beneficiario se modificó correctamente', 'redirect_to_listsa');
                    } else {
                        WaitDoc('Error al modificar', 'Intente más tarde.', 'CloseResponse()');
                    }
                },
                error: function () {
                    WaitDoc('Error al modificar', 'Ocurrió un error al enviar los datos para la modificación del beneficiario', 'CloseResponse()');
                }
            });
        });
</script>
