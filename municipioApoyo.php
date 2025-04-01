<?php
include 'conexion.php';
// Establish database connection
$conn = conectar();
if (empty($conn) || !($conn instanceof mysqli)) {
    $error = "⛔Error de conexión: <br>" . $conn;
}
?>
<?php if (isset($error)) { ?>
    <div id="Errores">
        <div id="Error">
            <p><?php echo $error; ?></p>
        </div>
    </div>
<?php } ?>
<!-- Formulario de registro de dotaciones -->
        <div class="FormData" style="width: 100%">
        
        <label for="localidad">Localidad:</label>
        <select name="localidad" id="localidad" required>
        <?php
            $sql = "SELECT CVE_LOC, NOM_LOC FROM cat_mun_loc WHERE CVE_MUN = ". $_POST ['data'];
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    echo "<option value='" . $row['CVE_LOC'] . "'>" . $row['NOM_LOC'] . "</option>";
                }
            }
        ?>
        </select>
        </div>

        
        

        <div class="FormData" style="width: 100%;">
        <label for="CP">Código Postal:</label>
        <select name="CP" id="CP">
        <?php
            $sql = "SELECT DISTINCT d_codigo FROM cp WHERE c_mnpio = ". $_POST ['data'];
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
    
        <?php include 'ventanaResponse.php'; ?>
        
        <hr>


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
            url: 'handleApoyados.php',
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
                WaitDoc('Error al registrar', 'Ocurrió un error al enviar los datos para el registro del beneficiario', 'CloseResponse()');
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

