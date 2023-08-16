<?php
    session_start();
    include_once("../../config/DBConect.php");
    include_once("../../config/Config.php");

    if(isset($_POST['nombre']))     $nombre = $_POST['nombre']; 
    if(isset($_POST['id']))         $id = $_POST['id']; 
    if(isset($_POST['notaMin']))    $notaMin = $_POST['notaMin']; 
    if(isset($_POST['notaMax']))    $notaMax = $_POST['notaMax']; 
    if(isset($_POST['esElectiva']))  
        $esElectiva = true; 
    else 
        $esElectiva = false;  

    $conexion = new Database;  
    $result = $conexion->updateMateria($nombre,$id,$notaMin,$notaMax,$esElectiva);

    header("Location: ".ROOT."modulos/materias/materias.php?mensaje=".$result);

?>