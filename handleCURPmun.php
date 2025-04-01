<?php
/* ESTA PAGINA FUE MODIFICADA POR EL USO DE UN WEB SERVICE PRIVADO */
/* THIS PAGE WAS MODIFIED BY THE USE OF A PRIVATE WEB SERVICE */
include 'conexion.php';
$conn = conectar();
if (empty($conn) || !($conn instanceof mysqli)) {
    $error = "⛔Error de conexión: <br>" . $conn;
}
?>

<?php
$curp=strtoupper($_POST['CURP']);
$encontrado=0;
$contador = 0;
if(preg_match("/^[A-Z]{4}\d{6}[HM][A-Z]{2}[B-DF-HJ-NP-TV-Z]{3}[A-Z0-9][0-9]$/", $curp)){
    $query = $conn->prepare("SELECT curp FROM beneficiario");
    $query->execute();
    $query->bind_result($curps);
    $query->store_result();

    if($query->num_rows === 0){
        $encontrado = 1;
    }else{
        while($query->fetch()){
            if($curps != $curp){
                $encontrado=1;
            }else{
                $encontrado=2;
                break;
            }
        }
    }
}


?>




<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Include common resources -->
    <?php include 'commonResources.php'; ?>
    <title>Captura (Funcionales)</title>
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

<!-- LOS ERRORES QUE DARIA EL WEB SERVICE EN CASO DE QUE LA CURP NO FUERA ACEPTADA -->
<?php if ($encontrado == 0) { ?>
    <h1 class='sinacceso'>CURP no encontrada</h1>
    <?php }else if($encontrado == 2){ ?>
        <h1 class='sinacceso'>CURP ya registrada.</h1>
    <?php }else if($encontrado == 6){ ?>
        <h1 class='sinacceso'>CURP no valida.</h1>
        <h2 class='sinacceso'>La CURP que ingreso esta dada de baja por documento apócrifo.</h2>
    <?php }else if($encontrado == 7){ ?>
        <h1 class='sinacceso'>CURP no valida.</h1>
        <h2 class='sinacceso'>La CURP que ingreso esta sin uso.</h2>
    <?php }else if($encontrado == 8){ ?>
        <h1 class='sinacceso'>CURP no valida.</h1>
        <h2 class='sinacceso'>La CURP que ingreso esta dada de baja por defunción.</h2>
    <?php }else if($encontrado == 9){ ?>
        <h1 class='sinacceso'>CURP no valida.</h1>
        <h2 class='sinacceso'>La CURP que ingreso tiene baja administrativa.</h2>
    <?php }else if($encontrado == 10){ ?>
        <h1 class='sinacceso'>CURP no valida.</h1>
        <h2 class='sinacceso'>La CURP que ingreso esta dada de baja por adopción.</h2>
    <?php }else if($encontrado == 11){ ?>
        <h1 class='sinacceso'>CURP no valida.</h1>
        <h2 class='sinacceso'>La CURP que ingreso tiene baja Judicial.</h2>
    <?php }else if($encontrado == 12){ ?>
        <h1 class='sinacceso'>CURP no valida.</h1>
        <h2 class='sinacceso'>La CURP es de estado desconocido.</h2>
    <?php }else { ?>
<!-- Formulario de registro de dotaciones -->
<!-- LOS INPUT QUE ESTAN EN "readonly" SE LLENABAN AUTOMATICAMENTE CON EL WEBSERVICE -->
<h1 class='sinacceso'>Registrar Beneficiario</h1>
<form id="registroDotaciones" method="post" action="">
    <div id="registroDotacionesInputs">

        <div class="FormData">
            <input type="hidden" name="idu" id="idu" placeholder="ID(No se va a modificar)" value="<?php echo $_SESSION['id'] ?>">
        </div>

        <div class="FormData">
            <input type="hidden" name="curp" id="curp" placeholder="CURP" value="<?php echo $curp ?>">
        </div>
        
        <div class="FormData" style="width: 33.3%;">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre" maxlength="255" readonly>    
        </div>

        <div class="FormData" style="width: 33.3%;">
            <label for="paterno">Apellido paterno:</label>
            <input type="text" name="paterno" id="paterno" placeholder="Apellido paterno" maxlength="255" readonly>    
        </div>

        <!-- EN CASO DE QUE AL INGRESAR LA CURP NO MOSTRARA APELLIDO MATERNO -->
        <div class="FormData" style="width: 33.3%;">
            <label for="materno">Apellido materno:</label>
            <input type="text" name="materno" id="materno" placeholder="Apellido materno" maxlength="255" readonly>
            <?php
            // if (empty((array) $obj)) {
            //     echo '<input type="text" name="materno" id="materno" placeholder="Apellido materno" maxlength="255" readonly>';
            // } else {
            //     echo "<input type='text' name='materno' id='materno' placeholder='Apellido materno' maxlength='255' value='$materno' readonly> ";
            // }
            ?>     
        </div>

        <div class="FormDataRadio" style="width: 33.3%;">
            <label for="genero">Sexo:</label><br>
            <input type="text" name="genero" id="genero" placeholder="Sexo" maxlength="255" readonly>
        </div>

        <div class="FormDataRadio" style="width: 33.3%;">
            <label for="fechnac">Fecha de nacimiento:</label><br>
            <input type="text" name="fechnac" id="fechnac" placeholder="Fecha de nacimiento" maxlength="255" readonly>
        </div>

        <div class="FormData" style="width: 33.3%;">
            <label for="entidad">Estado de nacimiento:</label>
            <input type="text" name="entidad" id="entidad" placeholder="Entidad Federativa" maxlength="255" readonly>    
        </div>

        <div class="FormData" style="width: 33.3%;">
            <label for="civil">Estado Civil:</label>
            <select name="civil" id="civil">
                <option value="Soltero">Soltero</option>
                <option value="Casado">Casado</option>
                <option value="Divorciado">Divorciado</option>
                <option value="Viudo">Viudo</option>
            </select>
        </div>

        <div class="FormDataRadio" style="width: 33.3%;">
        <label for="discapacidad">Discapacidad:</label><br><br>
        <input type="radio" name="discapaz" id="discapasi" value="Si" checked="checked">
        <label for="discapasi">Si</label>
        <input type="radio" name="discapaz" id="discapano" value="No">
        <label for="discapano">No</label>
        <br><br>
        </div>

        <div class="FormData" style="width: 33.3%;">
            <label for="aparato">Aparato:</label>
            <select name="aparato" id="aparato">
                <option value="Ruedas">Silla de ruedas</option>
                <option value="PCI">Silla de PCI</option>
                <option value="PCA">Silla de PCA</option>
                <option value="Bath">Silla de baño</option>
                <option value="Andadera">Andadera</option>
                <option value="Baston">Baston</option>
                <option value="Baston4">Baston de 4 Puntos</option>
                <option value="Auditivo">Aparato Auditivo</option>
                <option value="Muletas">Muletas</option>
                <option value="Optometrico">Optométrico</option>
                <option value="Diadema"> Aparatos auditivos (Diadema)</option>
                <option value="Rinfantil">Silla de Ruedas (Infantil)</option>
                <option value="BInvidente">Baston para Invidente</option>
            </select>   
        </div>

        <div class="FormDataRadio" style="width: 100%;">
            <label for="poblacion">Poblacion:</label><br><br>
            <input type="radio" name="poblacion" id="poblacioni" value="Indigena">
            <label for="poblacioni">Indigena</label>
            <input type="radio" name="poblacion" id="poblaciona" value="Afromexicano">
            <label for="poblaciona">Afromexicano</label> 
            <input type="radio" name="poblacion" id="poblaciono" value="Otros" checked="checked">
            <label for="poblaciono">Otros</label> 
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
                    echo "<option value='" . $row['Id_Cat_Tip_Via'] . "'>" . $row['Des_Cat_Tip_Via'] . "</option>";
                }
            }
        ?>
        </select>
        </div>
        
        <div class="FormData" style="width: 33.3%;">
        <label for="nombrevial">Nombre de la vialidad:</label>
        <input type="text" name="nombrevial" id="nombrevial" placeholder="Nombre de la vialidad" maxlength="255" required>
        </div>

        <div class="FormData" style="width: 33.3%;">
        <label for="numext">Numero Exterior:</label>
        <input type="number" name="numext" id="numext" placeholder="Numero Exterior" maxlength="5" min="0" required>
        </div>

        <div class="FormData" style="width: 33.3%;">
        <label for="letraext">Letra Exterior:</label>
        <input type="text" name="letraext" id="letraext" placeholder="Letra Exterior" maxlength="1">
        </div>

        <div class="FormData" style="width: 33.3%;">
        <label for="numint">Numero Interior:</label>
        <input type="number" name="numint" id="numint" placeholder="Numero Interior" maxlength="5" min="0">
        </div>

        <div class="FormData" style="width: 33.3%;">
        <label for="letraint">Letra Interior:</label>
        <input type="text" name="letraint" id="letraint" placeholder="Letra Interior" maxlength="1">
        </div>

        <div class="FormData" style="width: 33.3%;">
        <label for="nombreasen">Nombre de asentamiento:</label>
        <input type="text" name="nombreasen" id="nombreasen" placeholder="Nombre de asentamiento" maxlength="255" required>
        </div>

        <div class="FormData" style="width: 33.3%;">
        <label for="tipo_asen">Tipo de asentamiento:</label>
        <select name="tipo_asen" id="tipo_asen">
        <?php
            $sql = "SELECT Des_Ase FROM cat_ase";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    echo "<option value='" . $row['Des_Ase'] . "'>" . $row['Des_Ase'] . "</option>";
                }
            }
        ?>
        </select>
        </div>

        <div class="FormData" style="width: 33.3%;">
        <label for="referencia">Referencia:</label>
        <input type="text" name="referencia" id="referencia" placeholder="Referencia" maxlength="255" required>
        </div>

        <div class="FormData" style="width: 33.3%;">
        <label for="celular">Celular:</label>
        <input type="number" name="celular" id="celular" placeholder="Celular" maxlength="10" min="0" required>
        </div>

        <div class="FormData" style="width: 33.3%;">
            <label for="municipio">Municipio:</label>
            <select name="municipio" id="municipio">
                    <?php
            $sql = "SELECT DISTINCT CVE_MUN, NOM_MUN FROM cat_mun_loc WHERE CVE_MUN =".$_SESSION['clave_municipio'].";";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    echo "<option selected value='" . $row['CVE_MUN'] . "'>" . $row['NOM_MUN'] . "</option>";
                }
            }
            
            ?>
            </select>
        </div>
        <div class="FormData" style="width: 33.3%">
        
        <label for="localidad">Localidad:</label>
        <select name="localidad" id="localidad" required>
        <?php
            $sql = "SELECT CVE_LOC, NOM_LOC FROM cat_mun_loc WHERE CVE_MUN = ". $_SESSION['clave_municipio'].";";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    echo "<option value='" . $row['CVE_LOC'] . "'>" . $row['NOM_LOC'] . "</option>";
                }
            }
        ?>
        </select>
        </div>

        
        

        <div class="FormData" style="width: 33.3%;">
        <label for="CP">Código Postal:</label>
        <select name="CP" id="CP">
        <?php
            $sql = "SELECT DISTINCT d_codigo FROM cp WHERE c_mnpio = ".$_SESSION['clave_municipio'].";";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    echo "<option value='" . $row['d_codigo'] . "'>" . $row['d_codigo'] . "</option>";
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
        <div class="FormData" style="width: 33.3%;"></div>
        
        
    
    <?php include 'ventanaResponse.php'; ?>
</form>

<?php } ?>

<script>
let isSubmitting = false; // Bandera para controlar el estado de envío

$(document).ready(function() {
    $('#registroDotaciones').submit(function(e) {
        e.preventDefault(); // Prevenir el envío por defecto del formulario

        if (isSubmitting) return; // No enviar si ya está en proceso

        isSubmitting = true; // Marcar como enviando

        var formData = new FormData(this);
        formData.append('accion', 'registrarUsuario');
        
        var $submitButton = $('#registroDotaciones').find('button[type="submit"]');
        $submitButton.prop('disabled', true); // Deshabilitar el botón de envío

        $.ajax({
            url: 'handlepersona.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                WaitDoc('Registrando Beneficiario', 'Por favor espere un momento', 'location.reload()');
            },
            success: function(response) {
                console.log(response);
                if (response === 'Success') {
                    WaitDoc('Beneficiario registrado', 'El beneficiario se registró correctamente.', 'redirect_to_index');
                } else if(response === 'Error'){
                    WaitDoc('Error al registrar', 'Ocurrió un error al registrar al beneficiario, intenté más tarde.', 'CloseResponse()');
                } else if(response === 'Registrado'){
                    WaitDoc('Error al registrar', 'Esta CURP ya esta registrada.', 'CloseResponse()');
                }else {
                    WaitDoc('Error al registrar', 'Ya no hay '+response+'.', 'CloseResponse()');
                }
            },
            error: function() {
                WaitDoc('Error al registrar', 'Ocurrió un error al enviar los datos para registrar al beneficiario', 'CloseResponse()');
            },
            complete: function() {
                $submitButton.prop('disabled', false); // Habilitar el botón de envío
                isSubmitting = false; // Marcar como no enviando
            }
        });
    });

    $('#municipio').change(function() {
        // Si es necesario, podrías realizar alguna lógica aquí
    });
});
</script>