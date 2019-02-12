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
        case 'editarAuto':
        $placa=filter_var($obj->placa, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
        $marca=filter_var($obj->marca, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
        $modelo=filter_var($obj->modelo, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
        $color=filter_var($obj->color, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
        $capacidad=filter_var($obj->capacidad, FILTER_SANITIZE_NUMBER_INT);
        $maletera=filter_var($obj->maletera, FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ENCODE_LOW);
        $sql="UPDATE autos SET marca='$marca',modelo='$modelo',color='$color',capacidad='$capacidad',maletera='$maletera' WHERE placa='$placa'";
        $result=mysqli_query($conexion,$sql);
        if($result==1){
            $respuesta=array(
                'message' => 'OK'
            );
            echo json_encode($respuesta);
        }else{
            echo json_encode(array('message' => 'Fallo'));
        }
    break;
    }    
?>