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
            $nombre=filter_var($obj->nombre, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
            $apellido=filter_var($obj->apellido, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
            $fecha_nac=filter_var($obj->fecha_nac, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
            $estado=false;
            $telf=filter_var($obj->telf, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ENCODE_LOW);
            $sql="INSERT  INTO usuarios VALUES ('$ci','$nombre','$apellido','$fecha_nac','$estado','$pass','$telf')";
            $result=mysqli_query($conexion,$sql);
            if($result==1){
                $respuesta=array(
                    'message' => 'OK',
                    'ci' => $ci,
                    'nombre' => $nombre,
                    'apellido' => $apellido
                );
                echo json_encode($respuesta);
            }else{
                echo json_encode(array('message' => 'Fallo'));
            }
            
            
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