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
        $paterno=$_POST['paterno'];
        $materno=$_POST['materno'];
        $genero=$_POST['genero'];
        $fechnac=$_POST['fechnac'];
        $entidad=$_POST['entidad'];
        $civil=$_POST['civil'];
        $discapaz=$_POST['discapaz'];
        $aparato=$_POST['aparato'];
        $poblacion=$_POST['poblacion'];
        $tipovial=$_POST['tipovial'];
        $nombrevial=$_POST['nombrevial'];
        $numext=$_POST['numext'];
        $letraext=$_POST['letraext'];
        $numint=$_POST['numint'];
        $letraint=$_POST['letraint'];
        $nombreasen=$_POST['nombreasen'];
        $tipo_asen=$_POST['tipo_asen'];
        $referencia=$_POST['referencia'];
        $celular=$_POST['celular'];
        $municipio=$_POST['municipio'];
        $localidad=$_POST['localidad'];
        $CP=$_POST['CP'];
        $id_usuario=$_POST['idu'];
        $curp=$_POST['curp'];
        $especifico=$aparato;
        $usados1=0;
        $disponibles1=0;
        $registrado=0;
        $nombrelocalidad = "";

        $query = $conn->prepare("SELECT COUNT(aparato) FROM beneficiario WHERE aparato='$aparato' AND id_usuario=$id_usuario;");
        $query->execute();
        $query->bind_result($usados);
        $query->store_result();
        while($query->fetch()){
            $usados1=$usados;
        }

        switch ($aparato){
            case "Ruedas":
                $especifico="silla_ruedas";
                break;
            case "PCI":
                $especifico="sillapci";
                break;
            case "PCA":
                $especifico="sillapca";
                break;
            case 'Bath':
                $especifico="sillabath";
            break;
            case 'Andadera':
                $especifico="andadera";
            break;
            case 'Baston':
                $especifico="baston";
            break;
            case 'Baston4':
                $especifico="baston4";
            break;
            case 'Auditivo':
                $especifico="auditivo";
            break;
            case 'Muletas':
                $especifico="muleta";
            break;
            case 'optometrico':
                $especifico="optometrico";
            break;
            case 'Diadema':
                $especifico="diadema";
            break;
            case 'Rinfantil':
                $especifico="ruedas_infantil";
            break;
            case 'BInvidente':
                $especifico="baston_invidente";
            break;
        }

        $query = $conn->prepare("SELECT $especifico FROM usuarios WHERE id=$id_usuario;");
        $query->execute();
        $query->bind_result($disponibles);
        $query->store_result();

        while($query->fetch()){
            $disponibles1=$disponibles;
        }

        $query = $conn->prepare("SELECT curp FROM beneficiario");
        $query->execute();
        $query->bind_result($copycurp);
        $query->store_result();

        while($query->fetch()){
            if($curp == $copycurp){
                $registrado=1;
                break;
            }
        }

        // Obtener el nombre de la localidad
        $query = $conn->prepare("SELECT NOM_LOC FROM cat_mun_loc WHERE CVE_LOC = $localidad AND CVE_MUN = $municipio");
        $query->execute();
        $query->bind_result($nom_loc);
        $query->store_result();

        if($query->fetch()){
            $nombrelocalidad = $nom_loc;
        }

        // Si ya todo esta bien se guardara en la base de datos.
        if($usados<$disponibles && $registrado==0){
            $query = $conn->prepare("INSERT INTO beneficiario (curp, nombres, paterno, materno, genero, fecha_nacimiento, estado_civil, discapacidad, aparato, poblacion, Id_Cat_Tip_Via, nombre_vial, numero_ext, letra_ext, numero_int, letra_int, nombre_asen, tipo_asen, referencia, celular, CVE_MUN, localidad, c_postal, id_usuario, fecha_registro, clave_localidad, estado_nacimiento) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?)");
            $query->bind_param("ssssssssssisisisssssissiis", $curp, $nombre, $paterno, $materno, $genero, $fechnac, $civil, $discapaz, $aparato, $poblacion, $tipovial, $nombrevial, $numext, $letraext, $numint, $letraint, $nombreasen, $tipo_asen, $referencia, $celular, $municipio, $nombrelocalidad, $CP, $id_usuario, $localidad, $entidad);
            if($query->execute()){
                echo "Success";
            } else {
                echo "Error";
            }
            $usados=$disponibles;
        }else if($registrado==1){
            echo "Registrado";
        }else if($usados>=$disponibles){
            switch ($aparato){
                case "Ruedas":
                    $especifico="Sillas de ruedas";
                    break;
                case "PCI":
                    $especifico="Sillas PCI";
                    break;
                case "PCA":
                    $especifico="Sillas PCA";
                    break;
                case 'Bath':
                    $especifico="Sillas de baño";
                break;
                case 'Andadera':
                    $especifico="Andaderas";
                break;
                case 'Baston':
                    $especifico="Bastones";
                break;
                case 'Baston4':
                    $especifico="Bastones de 4 Puntos";
                break;
                case 'Auditivo':
                    $especifico="Aparatos auditivos";
                break;
                case 'Muletas':
                    $especifico="Muletas";
                break;
                case 'Optometrico':
                    $especifico="Aparatos Optométricos";
                break;
                case 'Diadema':
                    $especifico="Aparatos auditivos (Diadema)";
                break;
                case 'Rinfantil':
                    $especifico="Sillas de Ruedas (Infantil)";
                break;
                case 'BInvidente':
                    $especifico="Bastones para Invidentes";
                break;
                default:
                    $especifico="Error";
            }
            echo $especifico;
        }
        

        
        
        
        
    }
    else if ($_POST['accion'] == 'modificarUsuario') {
        $idb=$_POST['idb'];
        $civil=$_POST['civil'];
        $poblacion=$_POST['poblacion'];
        $discapaz=$_POST['discapaz'];
        $tipovial=$_POST['tipovial'];
        $nombrevial=$_POST['nombrevial'];
        $numext=$_POST['numext'];
        $letraext=$_POST['letraext'];
        $numint=$_POST['numint'];
        $letraint=$_POST['letraint'];
        $nombreasen=$_POST['nombreasen'];
        $tipo_asen=$_POST['tipo_asen'];
        $referencia=$_POST['referencia'];
        $celular=$_POST['celular'];
        $municipio=$_POST['municipio'];
        $localidad=$_POST['localidad'];
        $CP=$_POST['CP'];
        $nombrelocalidad = "";

        // Obtener el nombre de la localidad
        $query = $conn->prepare("SELECT NOM_LOC FROM cat_mun_loc WHERE CVE_LOC = $localidad AND CVE_MUN = $municipio");
        $query->execute();
        $query->bind_result($nom_loc);
        $query->store_result();

        if($query->fetch()){
            $nombrelocalidad = $nom_loc;
        }

        $query = $conn->prepare("UPDATE beneficiario SET estado_civil = ?, discapacidad = ?, poblacion = ?, Id_Cat_Tip_Via = ?, nombre_vial = ?, numero_ext = ?, letra_ext = ?, numero_int = ?, letra_int = ?, nombre_asen = ?, tipo_asen = ?, referencia = ?, celular = ?, CVE_MUN = ?, localidad = ?, c_postal = ?, clave_localidad = ? WHERE id_beneficiario = ?");
        $query->bind_param("sssisisisssssissii", $civil, $discapaz, $poblacion, $tipovial, $nombrevial, $numext, $letraext, $numint, $letraint, $nombreasen, $tipo_asen, $referencia, $celular, $municipio, $nombrelocalidad, $CP, $localidad, $idb);

        
        if($query->execute()){
            echo "Success";
        } else {
            echo "Error: " . $query . "<br>" . $query->error;
        }
    }else if($_POST['accion'] == 'eliminar'){
        $id_beneficiario = $_POST['id'];
        $carpeta = "IMGFUNCIONALES2024";
        if(file_exists("IMGFUNCIONALES2024/CURP/$id_beneficiario.pdf")){
            unlink("IMGFUNCIONALES2024/CURP/$id_beneficiario.pdf");
        }
        if(file_exists("IMGFUNCIONALES2024/Domicilio/$id_beneficiario.pdf")){
            unlink("IMGFUNCIONALES2024/Domicilio/$id_beneficiario.pdf");
        }   
        if(file_exists("IMGFUNCIONALES2024/Estudios/$id_beneficiario.pdf")){
            unlink("IMGFUNCIONALES2024/Estudios/$id_beneficiario.pdf");
        } 
        if(file_exists("IMGFUNCIONALES2024/Foto/$id_beneficiario.pdf")){
            unlink("IMGFUNCIONALES2024/Foto/$id_beneficiario.pdf");
        } 
        if(file_exists("IMGFUNCIONALES2024/FotoEntrega/$id_beneficiario.pdf")){
            unlink("IMGFUNCIONALES2024/FotoEntrega/$id_beneficiario.pdf");
        } 
        if(file_exists("IMGFUNCIONALES2024/IdBeneficiario/$id_beneficiario.pdf")){
            unlink("IMGFUNCIONALES2024/IdBeneficiario/$id_beneficiario.pdf");
        } 
        if(file_exists("IMGFUNCIONALES2024/Indicacion/$id_beneficiario.pdf")){
            unlink("IMGFUNCIONALES2024/Indicacion/$id_beneficiario.pdf");
        } 
        if(file_exists("IMGFUNCIONALES2024/INE/$id_beneficiario.pdf")){
            unlink("IMGFUNCIONALES2024/INE/$id_beneficiario.pdf");
        } 
        if(file_exists("IMGFUNCIONALES2024/Recibo/$id_beneficiario.pdf")){
            unlink("IMGFUNCIONALES2024/Recibo/$id_beneficiario.pdf");
        } 
        if(file_exists("IMGFUNCIONALES2024/Solicitud/$id_beneficiario.pdf")){
            unlink("IMGFUNCIONALES2024/Solicitud/$id_beneficiario.pdf");
        } 
        

        $query1 = $conn->prepare("DELETE FROM beneficiario WHERE id_beneficiario = ?");
        $query1->bind_param("i", $id_beneficiario);

        if($query1->execute()){
            echo "Success";
        } else {
            echo "Error: " . $query1 . "<br>" . $query1->error;
        }
    }else if($_POST['accion'] == 'validar'){
        $id_beneficiario = $_POST['id'];
        $supervisor = $_POST['supervisor'];
        $validar="Si";

        $query = $conn->prepare("UPDATE beneficiario SET validado = ?, id_supervisor =  ?, fecha_validacion = NOW() WHERE id_beneficiario = ?");
        $query->bind_param("sii",$validar, $supervisor, $id_beneficiario);

        if($query->execute()){
            echo "Success";
        }else{
            echo "Error: ". $query . "<br>" . $query->error;
        }
    }else if($_POST['accion'] === 'comentar'){
        $id_beneficiario = $_POST['id'];
        $nota = $_POST['nota'];

        $query = $conn->prepare("UPDATE beneficiario SET comentario = ? WHERE id_beneficiario = ?");
        $query->bind_param("si",$nota, $id_beneficiario);

        if($query->execute()){
            echo "Success";
        }else{
            echo "Error: ". $query . "<br>" . $query->error;
        }
    }
}