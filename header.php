<?php
    // Si no hay una sesión iniciada, iniciarla
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    // Si no hay un usuario loggeado, redirigir a la página de login
    if(!isset($_SESSION['usuario']) || !$_SESSION['LoggedIn']){
        header('Location: login.php');
    }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Include common resources -->
    <?php include 'commonResources.php'; ?>
    <title>Header</title>
    <!-- Styles -->
    <link rel="stylesheet" href="Styles/headerStyles.css">
</head>

<body>
    <div id="Header">
        <!-- Header menu Logo y Menú -->
        <div id="HeaderMenu">
            <!-- Header Logo -->
            
            <!-- Header menu de navegación -->
            <ul class="HeaderMenuNav">
            <li class="MenuNavOption"></li>
                <li class="MenuNavOption"><a href="index.php">Inicio</a></li><!-- Boton de incio -->
                <!-- <li class="MenuNavOption"><a href="escuela.php">Escuelas</a></li>Boton de escuelas -->
                    
                <?php if ($_SESSION['rol'] == 1) { ?>
                    <li class="MenuNavOption"><a href="controlUsuarios.php">Usuarios</a></li><!-- Boton de usuarios -->
                    <li class="MenuNavOption"><a href="VerValidados.php">Validados</a></li><!-- Boton de usuarios -->
                    <li class="MenuNavOption"><a href="ListaBeneficiarios.php">Beneficiarios</a></li>
                    <li class="MenuNavOption"><a href="Descargas.php">Descargas</a></li>
                <?php } ?>

                <!-- Botones del rol de municipio  y supervisor -->
                <?php if ($_SESSION['rol'] == 2 || $_SESSION['rol'] == 3) { 
                    if($_SESSION['rol'] == 3){?>
                    <li class="MenuNavOption"><a>Registrar</a>
                    <ul class="submenu">
                        <li><a href="ingresarCURP.php">Funcionales</a></li>
                        <li><a href="IngresarCURPApoyo.php">Apoyo</a></li>
                        
                    </ul>
                    </li><!-- Boton para registrar beneficiarios -->
                    <?php }else{ ?>
                        <li class="MenuNavOption"><a href="ingresarCURP.php">Registrar</a></li>
                        <?php } ?>
                    <li class="MenuNavOption"><a href="VerBeneficiarios.php">Funcionales</a></li><!-- Boton para consultar beneficiarios con aparatos funcionales -->
                    <li class="MenuNavOption"><a href="VerAuditivos.php">Auditivos</a></li><!-- Boton para consultar beneficiarios con aparatos auditivos -->
                    <?php if ($_SESSION['rol'] == 3) { ?>
                        <li class="MenuNavOption"><a>Documentos</a>
                        <ul class="submenu">
                        <li><a href="UsuariosconBeneficiarios.php">Funcionales</a></li>
                        <li><a href="ListaApoyados.php">Apoyo</a></li>
                    </li><!-- Boton para consultar beneficiarios con select -->
                        
                    </ul>
                    <?php }else if($_SESSION['rol'] == 2){ ?>
                        <li class="MenuNavOption"><a href="RevisarBeneficiarios.php">Documentos</a></li><!-- Boton para consultar beneficiarios pocos datos-->
                    <?php } ?>
                    <li class="MenuNavOption"><a href="RevisarAvance.php">Avance</a></li><!-- Boton para consultar avance de los aparatos -->
                    <li class="MenuNavOption"><a href="Descargas.php">Descargas</a></li>
                <?php } ?>
                
                
            </ul>
        </div>
        <!-- Header cuenta Menú de usuario -->
        <div id="HeaderAccount">
            <div id="HeaderAccountButton"><img id="HeaderAccountImage" src="Media/AccountIconBlanco.png"
                    alt="Imagen de perfil"></div>
            <div id="HeaderAccountMenu">
                <span style="text-align: center; text-transform: uppercase; padding: 15px 20px; font-size: larger;"><?php echo $_SESSION ['usuario']?></span>
                <hr>
                <a href="perfil.php"><i class="bi bi-person-fill"></i> Mi perfil</a>
                <hr>
                <a href="logout.php"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a>
            </div>
        </div>
    </div>
</body>

</html>
<script>
// Boton clickeable de la cuenta
document.getElementById('HeaderAccountButton').addEventListener('click', function() {
    event.stopPropagation();
    document.getElementById('HeaderAccountMenu').classList.toggle('show');
});

// Cerrar el menú de la cuenta si se hace clic fuera de él
window.onclick = function(event) {
    var accountButton = document.getElementById('HeaderAccountButton');
    var accountMenu = document.getElementById('HeaderAccountMenu');
    if (!accountMenu.contains(event.target) && !accountButton.contains(event.target)) {
        accountMenu.classList.remove('show');
    }
};

// Cerrar la sesión cuando se cierra la pestaña
let isPageVisible = true;

document.addEventListener('visibilitychange', function() {
    isPageVisible = !document.hidden;
});

window.addEventListener('beforeunload', function (event) {
    if (!isPageVisible) {
        navigator.sendBeacon('logout.php');
    }
});
</script>