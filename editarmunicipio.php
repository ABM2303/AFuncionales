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
        </form>

<script>
let isSubmitting = false; // Bandera para controlar el estado de envío

$(document).ready(function() {
    $('#FormEditarBeneficiario').submit(function(e) {
        e.preventDefault(); // Prevenir el envío por defecto del formulario

        if (isSubmitting) return; // No enviar si ya está en proceso

        isSubmitting = true; // Marcar como enviando

        var formData = new FormData(this);
        formData.append('accion', 'modificarUsuario');
        
        var $submitButton = $('#FormEditarBeneficiario').find('button[type="submit"]');
        $submitButton.prop('disabled', true); // Deshabilitar el botón de envío

        $.ajax({
            url: 'handlepersona.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                WaitDoc('Modificando Beneficiario', 'Por favor espere un momento', 'location.reload()');
            },
            success: function(response) {
                console.log(response);
                if (response === 'Success') {
                    WaitDoc('Beneficiario modificado', 'El beneficiario se modificó correctamente', 'redirect_to_lists');
                } else {
                    WaitDoc('Error al modificar', 'Intente más tarde.', 'CloseResponse()');
                }
            },
            error: function() {
                WaitDoc('Error al modificar', 'Ocurrió un error al enviar los datos para la modificación del beneficiario', 'CloseResponse()');
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