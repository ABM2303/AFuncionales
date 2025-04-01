<?php
session_start();
include 'conexion.php';
$conn = conectar();
if (empty($conn) || !($conn instanceof mysqli)) {
    $error = "⛔Error de conexión: <br>" . $conn;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['accion'] == 'registrarUsuario') {
        $id_usuario=$_POST['idu'];
        $curp=$_POST['curp'];
        $nombre=$_POST['nombre'];
        $paterno=$_POST['paterno'];
        $materno=$_POST['materno'];
        $genero=$_POST['genero'];
        $fechnac=$_POST['fechnac'];
        $entidad=$_POST['entidad'];
        $civil=$_POST['civil'];
        $discapaz=$_POST['discapaz'];
        $apoyo=$_POST['apoyo'];
        $monto=$_POST['monto'];
        $poblacion=$_POST['poblacion'];
        $comentario=$_POST['comentario'];
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
        $registrado = 0;
        $query = $conn->prepare("SELECT curp FROM apoyado");
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

        //Si no hay doble registro lo guarda en la tabla "apoyado"
        if($registrado==0){
            $query = $conn->prepare("INSERT INTO apoyado (curp, nombres, paterno, materno, genero, fecha_nacimiento, estado_civil, discapacidad, id_apoyo, monto, poblacion, comentario, Id_Cat_Tip_Via, nombre_vial, numero_ext, letra_ext, numero_int, letra_int, nombre_asen, tipo_asen, referencia, celular, CVE_MUN, localidad, c_postal, id_usuario, fecha_registro, clave_localidad, estado_nacimiento) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?)");
            $query->bind_param("ssssssssiissisisisssssissiis", $curp, $nombre, $paterno, $materno, $genero, $fechnac, $civil, $discapaz, $apoyo, $monto, $poblacion, $comentario, $tipovial, $nombrevial, $numext, $letraext, $numint, $letraint, $nombreasen, $tipo_asen, $referencia, $celular, $municipio, $nombrelocalidad, $CP, $id_usuario, $localidad, $entidad);
            if($query->execute()){
                echo "Success";
            } else {
                echo "Error";
            }
        }else if($registrado==1){
            echo "Registrado";
        }   
    }
    else if ($_POST['accion'] == 'modificarUsuario') {
        $idb=$_POST['idb'];
        $civil=$_POST['civil'];
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

        $apoyo=$_POST['apoyo'];        
        $monto=$_POST['monto'];
        $comentario=$_POST['comentario'];
        $discapaz=$_POST['discapaz'];

        $nombrelocalidad = "";

        // Obtener el nombre de la localidad
        $query = $conn->prepare("SELECT NOM_LOC FROM cat_mun_loc WHERE CVE_LOC = $localidad AND CVE_MUN = $municipio");
        $query->execute();
        $query->bind_result($nom_loc);
        $query->store_result();

        if($query->fetch()){
            $nombrelocalidad = $nom_loc;
        }


        $query = $conn->prepare("UPDATE apoyado SET estado_civil = ?, discapacidad = ?, id_apoyo = ?, monto = ?, poblacion = ?, comentario = ?, Id_Cat_Tip_Via = ?, nombre_vial = ?, numero_ext = ?, letra_ext = ?, numero_int = ?, letra_int = ?, nombre_asen = ?, tipo_asen = ?, referencia = ?, celular = ?, CVE_MUN = ?, localidad = ?, c_postal = ?, clave_localidad = ? WHERE id_apoyado = ?");
        $query->bind_param("ssiissisisisssssissii", $civil, $discapaz, $apoyo, $monto, $poblacion, $comentario, $tipovial, $nombrevial, $numext, $letraext, $numint, $letraint, $nombreasen, $tipo_asen, $referencia, $celular, $municipio, $nombrelocalidad, $CP, $localidad, $idb);

        
        if($query->execute()){
            echo "Success";
        } else {
            echo "Error: " . $query . "<br>" . $query->error;
        }
    }else if($_POST['accion'] == 'eliminar'){
        $id_beneficiario = $_POST['id'];
        
        if(file_exists("IMGAPOYOS2024/CURP/$id_beneficiario.pdf")){
            unlink("IMGAPOYOS2024/CURP/$id_beneficiario.pdf");
        }
        if(file_exists("IMGAPOYOS2024/Domicilio/$id_beneficiario.pdf")){
            unlink("IMGAPOYOS2024/Domicilio/$id_beneficiario.pdf");
        }   
        if(file_exists("IMGAPOYOS2024/Estudios/$id_beneficiario.pdf")){
            unlink("IMGAPOYOS2024/Estudios/$id_beneficiario.pdf");
        } 
        if(file_exists("IMGAPOYOS2024/Foto/$id_beneficiario.pdf")){
            unlink("IMGAPOYOS2024/Foto/$id_beneficiario.pdf");
        } 
        if(file_exists("IMGAPOYOS2024/FotoEntrega/$id_beneficiario.pdf")){
            unlink("IMGAPOYOS2024/FotoEntrega/$id_beneficiario.pdf");
        } 
        if(file_exists("IMGAPOYOS2024/IdBeneficiario/$id_beneficiario.pdf")){
            unlink("IMGAPOYOS2024/IdBeneficiario/$id_beneficiario.pdf");
        } 
        if(file_exists("IMGAPOYOS2024/Indicacion/$id_beneficiario.pdf")){
            unlink("IMGAPOYOS2024/Indicacion/$id_beneficiario.pdf");
        } 
        if(file_exists("IMGAPOYOS2024/INE/$id_beneficiario.pdf")){
            unlink("IMGAPOYOS2024/INE/$id_beneficiario.pdf");
        } 
        if(file_exists("IMGAPOYOS2024/Recibo/$id_beneficiario.pdf")){
            unlink("IMGAPOYOS2024/Recibo/$id_beneficiario.pdf");
        } 
        if(file_exists("IMGAPOYOS2024/Solicitud/$id_beneficiario.pdf")){
            unlink("IMGAPOYOS2024/Solicitud/$id_beneficiario.pdf");
        } 
        

        $query1 = $conn->prepare("DELETE FROM apoyado WHERE id_apoyado = ?");
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

        $query = $conn->prepare("UPDATE apoyado SET validado = ?, id_supervisor =  ?, fecha_validacion = NOW() WHERE id_apoyado = ?");
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