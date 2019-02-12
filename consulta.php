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
    /*$ci=filter_var($obj->ci, FILTER_SANITIZE_NUMBER_INT);
    $pass=filter_var($obj->pass, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);*/
    switch ($key) {
        case 'verificarExistenciaDeUsuarioPorCi':
            
        
            try
            {
                $ci=filter_var($obj->ci, FILTER_SANITIZE_NUMBER_INT);
                $pass=filter_var($obj->pass, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
                $sql="SELECT  ci,nombre,apellido,pass FROM usuarios WHERE pass= BINARY '".$pass."' and ci=".$ci;
                
                $result=mysqli_query($conexion,$sql);
                //echo json_encode('datos '.$ci.' y '.$pass);
                //echo json_encode('numero de filas: '.$result->num_rows);
                
                if($result->num_rows > 0)
                {
                    while($row = $result->fetch_assoc()) {
                        $senci=$row["ci"];
                        $sennombre=$row["nombre"];
                        $senapellido=$row["apellido"];
                        // echo "ci: " . $row["ci"]. " - nombre: " . $row["nombre"]. " " . $row["apellido"]. "<br>"; Prueba para ver si los datos se recuperan
                    }
                    $respuesta=array(
                        'message' => 'OK',
                        'ci' => $senci,
                        'nombre' => $sennombre,
                        'apellido' => $senapellido
                    );
                    echo json_encode($respuesta);
                }
                else
                {
                    echo json_encode(array('message' => 'No se encontró'));
                }
            }catch(Exception $e)
            {
                echo json_encode($e);
            }
        break;
    
         case 'listarAutos':

        try
        {
            $ci=filter_var($obj->ci, FILTER_SANITIZE_NUMBER_INT);
            $sql="SELECT a.placa, b.marca,b.color,b.capacidad,b.modelo,b.maletera FROM usuarios_autos a ,autos b WHERE a.placa=b.placa and a.ci=".$ci;
            $result=mysqli_query($conexion,$sql);
            $placas=array();
            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc()) {
                    $placas[]=$row;
                 }
                echo json_encode($placas);
            }
            else
            {
                echo json_encode(array('message' => 'No se encontró'));
            }
        }catch(Exception $e)
        {
            echo json_encode($e);
        }
    break;
}    
?>



