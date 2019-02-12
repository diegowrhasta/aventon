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
            $placa=filter_var($obj->placa, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
            $marca=filter_var($obj->marca, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
            $modelo=filter_var($obj->modelo, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
            $color=filter_var($obj->color, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
            $estado=false;
            $capacidad=filter_var($obj->capacidad, FILTER_SANITIZE_NUMBER_INT);
            $ci=filter_var($obj->id_usuario, FILTER_SANITIZE_NUMBER_INT);
            $maletera=filter_var($obj->maletera, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ENCODE_LOW);
            $sql="INSERT  INTO autos VALUES ('$placa','$marca','$modelo','$color','$estado','$capacidad','$maletera')";
            $result=mysqli_query($conexion,$sql);
            if($result==1){
                $respuesta=array(
                    'message' => 'OK',
                    'placa' => $placa,
                    'capacidad' => $capacidad,
                    'maletera' => $maletera
                );
                echo json_encode($respuesta);
            }else{
                echo json_encode(array('message' => 'Fallo'));
            }
        break;
case 'intermedia':
            $placa=filter_var($obj->placa, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
            $ci=filter_var($obj->ci, FILTER_SANITIZE_NUMBER_INT);
	    $sql="INSERT  INTO usuarios_autos VALUES ('$ci','$placa')";
	    $result=mysqli_query($conexion,$sql);
            if($result==1){
                $respuesta=array(
                    'message' => 'OK',
                    'placa' => $placa
                );
                echo json_encode($respuesta);
            }else{
                echo json_encode(array('message' => 'Fallo'));
            }
        break;
    }    
?>