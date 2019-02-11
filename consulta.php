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
        case 'verificarExistenciaDeUsuarioPorCi':
            $ci=filter_var($obj->ci, FILTER_SANITIZE_NUMBER_INT);
            $pass=filter_var($obj->pass, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
            $sql="select ci,nombre,apellido,pass from usuarios where ci=$ci and pass = BINARY '$pass'" ;
            $result=mysqli_query($conexion,$sql);
            if($result->num_rows > 0 && $result==1)
            {
                while($row = $result->fetch_assoc()) {
                    $respuesta=array(
                        'message' => 'OK',
                        'ci' => $row["ci"],
                        'nombre' => $nombre,
                        'apellido' => $apellido
                    );
                    // echo "ci: " . $row["ci"]. " - nombre: " . $row["nombre"]. " " . $row["apellido"]. "<br>"; Prueba para ver si los datos se recuperan
                }
                echo json_encode($respuesta);
            }
            else
            {
                echo json_encode(array('message' => 'No se encontró'));
            }
        break;
    }    
?>

