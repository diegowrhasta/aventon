<?php
    header("Access-Control-Allow-Origin: *");
    require_once "../Clases/Conexion.php"; 
    $c= new conectar();
    $conexion=$c->conexion();
    

    $key=$_POST['key'];
    

    switch ($key) {
        case 'registrarUsuario':
            $ci=$_POST['ci'];
            $pass=$_POST['pass'];
            $nombre=$_POST['nombre'];   
            $apellido=$_POST['apellido'];
            $fecha_nac=$_POST['fecha_nac'];
            $estado='true';
            $telf=$_POST['telf'];
            $sql="INSERT  INTO usuarios VALUES ('$ci','$nombre','$apellido','$fecha_nac','$estado','$pass','$telf')";
            $result=mysqli_query($conexion,$sql);
            echo $result;
        break;
        case 'registrarAuto':
            $placa=$_POST['placa'];
            $marca=$_POST['marca'];
            $modelo=$_POST['modelo'];
            $color=$_POST['color'];
            $estado=$_POST['estado'];
            $capacidad=$_POST['capacidad'];
            $sql="INSERT  INTO autos VALUES ('$placa','$marca','$modelo','$color','$estado','$capacidad')";
            $result=mysqli_query($conexion,$sql);
            echo $result;
        break;
    }    
?>