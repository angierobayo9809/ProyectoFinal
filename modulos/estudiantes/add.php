<?php
    session_start();
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");    

    if(isset($_POST['identificacion'])) $identificacion = $_POST['identificacion']; 
    if(isset($_POST['nombres']))        $nombres = $_POST['nombres']; 
    if(isset($_POST['apellidos']))      $apellidos = $_POST['apellidos']; 
    if(isset($_POST['email']))          $email = $_POST['email']; 
    if(isset($_POST['telefono']))       $telefono = $_POST['telefono']; 
    if(isset($_POST['eps']))            $eps = $_POST['eps'];
    if(isset($_POST['tipoSanguineo']))  $tipoSanguineo = $_POST['tipoSanguineo'];
    if(isset($_POST['acudiente']))      $acudiente = $_POST['acudiente'];

    $conexion = new Database;  
    $result = $conexion->CrearEstudiante($identificacion,$nombres,$apellidos,$email,$telefono,$eps,$tipoSanguineo,$acudiente);

    header("Location: ".ROOT."modulos/estudiantes/estudiantes.php?mensaje=".$result);

?>