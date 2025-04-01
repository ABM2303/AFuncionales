<?php
function conectar(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "afuncionales";
    
    try {
      $conn = new mysqli($servername, $username, $password, $dbname);
      $conn->set_charset("utf8");
      return $conn;
    } catch (Exception $e) {
      return $e->getMessage();
    }
}
?>