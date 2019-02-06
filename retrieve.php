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
    //array para recibir una consulta
    $data = array();
    //try-catch para evitar errores
    try 
    {
        //FUNCION LISTAR
        //la variable $stmt tendra la consulta entre ''
        $stmt = $pdo->query('SELECT * FROM Usuario');
        //la variable $row recibe lo que la consulta devuelve por filas, FETCH_OBJ es para
        //configurar la respuesta como objeto, hay tambien FETCH_ARRAY para configurar la 
        //respuesta como array 
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            
            //asignamos cada fila a la variable data
            $data[] = $row;
        }
        // volvemos la variable una variable json y con echo lo enviamos como respuesta a
        //la aplicacion
        echo json_encode($data);
    } 
    //en caso de error 
    catch (PDOException $e) { 
        //mandamos el mensaje del error pero se puede mandar uno personalizado
        echo $e->getMessage();
    }
?>