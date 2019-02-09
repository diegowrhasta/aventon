<?php
    header("Access-Control-Allow-Origin: *");
    require_once "../Clases/Conexion.php"; 
    $c= new conectar();
    $conexion=$c->conexion();
    

    $key=$_POST['key'];
    

    switch ($key) {
        case 'verificarExistenciaDeUsuarioPorCi':
            $ci=$_POST['ci'];
            $pass=$_POST['pass'];
            $sql="select ci,nombre,apellido,pass from usuarios where ci=$ci and pass = BINARY '$pass'" ;
            $result=mysqli_query($conexion,$sql);
            if($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc()) {
                    echo "ci: " . $row["ci"]. " - nombre: " . $row["nombre"]. " " . $row["apellido"]. "<br>";
                }
            }
            else
            {
                echo "Not Found";  
            }
        break;
    }    
?>

