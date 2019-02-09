<?php
    header("Access-Control-Allow-Origin: *");
    require_once "../Clases/Conexion.php"; 
    $c= new conectar();
    $conexion=$c->conexion();
    

    $json = file_get_contents('php://input');
    //decodificamos la variable para manipular como objetos
    $obj = json_decode($json);
    // strip_tags limpia las etiquetas HTML del parametro
    $key = strip_tags($obj->key);
    // hacemos un switch para determinar la accion
    

    switch ($key) {
        case 'registrarUsuario':
            $ci=filter_var($obj->ci, FILTER_SANITIZE_NUMBER_INT);
            $pass=filter_var($obj->pass, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
            $nombre=$_POST['nombre'];   
            $apellido=$_POST['apellido'];
            $fecha_nac=$_POST['fecha_nac'];
            $estado='true';
            $telf=$_POST['telf'];
            $sql="INSERT  INTO usuarios VALUES ('$ci','$nombre','$apellido','$fecha_nac','$estado','$pass','$telf')";
            $result=mysqli_query($conexion,$sql);
            echo json_encode(array('message' => $result));
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