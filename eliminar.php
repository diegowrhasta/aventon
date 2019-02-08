<?php

    require_once "Conexion.php"; 
    $c= new conectar();
    $conexion=$c->conexion();
    

    $key=$_POST['key'];
    $correo=$_POST['correo'];
    $pass=$_POST['pass'];


    
    switch ($key) {
        case 'registrarUsuario':
            $sql="INSERT  INTO usuario VALUES (default,'$correo','$pass')";
            $result=mysqli_query($conexion,$sql);
            echo $result;
        break;

        
    }    
?>