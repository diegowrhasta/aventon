<?php

    require_once "../Clases/Conexion.php"; 
    $c= new conectar();
    $conexion=$c->conexion();
    

    $key=$_POST['key'];
    

    switch ($key) {
        case 'verificarExistenciaDeUsuarioPorCi':
            $ci=$_POST['ci'];
            $sql="select ci,nombre,apellido from usuarios where ci=$ci;";
            $result=mysqli_query($conexion,$sql);
            $dato=mysqli_fetch_row($result);
            if($dato[0]=="0"){
                echo "No Existe";
            }else{
                echo "Existe";
            }
            
        break;
    }    
?>

