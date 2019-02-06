<?php
    //permiso de acceso 
    header("Access-Control-Allow-Origin: *");

    //datos del servidor
    $host = 'localhost';
    $username = 'id8282114_root';
    $password = 'Element34';
    $database = 'id8282114_ionic';
    $charset = 'utf8';
    
    //variable configuracion para la conexion PDO
    $dsn = 'mysql:host='.$host.';port=3306;dbname='.$database.';charset='.$charset;
    //variables de opciones PDO
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_EMULATE_PREPARES => false,
    );

    // instancia de la base de datos, se pasa los parametros que se configuro
    $pdo = new PDO($dsn, $username, $password, $options);
    // la variable $json recupera todo lo solicitado al backend (variables input)
    $json = file_get_contents('php://input');
    //decodificamos la variable para manipular como objetos
    $obj = json_decode($json);
    // strip_tags limpia las etiquetas HTML del parametro
    $key = strip_tags($obj->key);
    // hacemos un switch para determinar la accion
    switch ($key) {
        // caso insertar
        case 'insertar':
            // obtenemos y limpiamos las variables que se necesite
            $email = filter_var($obj->email, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
            $pass = filter_var($obj->password, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
            // creamos la consulta 
            try {
                //consulta
                $sql = 'INSERT INTO Usuario(email,password) VALUES(:email, :pass)';
                //preparamos consulta (setup)
                $stmt = $pdo->prepare($sql);
                //configuramos los parametros de la consulta asignandole un valor
                //segun el tipo de variale PDO::PARAM_STR (string) PDO::PARAM_INT (entero) ...
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
                //ejecucion de la consulta
                $stmt->execute();
                //mandamos un mensaje en formato array (clave - valor) de confirmacion 
                echo json_encode(array('message' => 'Usuario registrado con exito'));
            }
            // en caso de error
            catch (PDOException $e) {
                //mandamos mensaje de error
                echo $e->getMessage();
            }
            break;
            //fin de insertar

            //LA LOGICA SE REPITE SEGUN LA TRANSACCION QUE SE DESEE

            
        // caso editar
        case 'editar':
            
            $id = filter_var($obj->id_usuario,FILTER_SANITIZE_NUMBER_INT);
            $email = filter_var($obj->email, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
            $pass = filter_var($obj->password, FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW);
            
            try {
                $sql = 'UPDATE Usuario SET email = :email,password = :pass WHERE id_usuario = :id';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                echo json_encode('Se actulizo el usuario: '.$email);
            }
            
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        break;
        //fin editar

        //caso eliminar
        case 'eliminar':
            
            $id = filter_var($obj->id_usuario,FILTER_SANITIZE_NUMBER_INT);
            // Menjalankan PDO dengan prepared statement
            try {
                $sql = 'DELETE FROM Usuario WHERE id_usuario = :id';
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                echo json_encode('Usuario eliminado');
            }
            
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        break;
        //fin eliminar
    }

?>