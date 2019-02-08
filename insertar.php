<?php

    require_once "../Clases/Conexion.php"; 
    $c= new conectar();
    $conexion=$c->conexion();
    

    $key=$_POST['key'];
    

    switch ($key) {
        case 'registrarUsuario':
            $correo=$_POST['correo'];
            $pass=$_POST['pass'];
            $sql="INSERT  INTO usuario VALUES (default,'$correo','$pass')";
            $result=mysqli_query($conexion,$sql);
            echo $result;
        break;
        case 'registrarAuto':
            $correo=$_POST['correo'];
            $pass=$_POST['pass'];
            $sql="INSERT  INTO usuario VALUES (default,'$correo','$pass')";
            $result=mysqli_query($conexion,$sql);
            echo $result;
        break;

        
    }    
?>