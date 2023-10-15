<?php

class Connection extends Mysqli {
    function __construct() {
        parent::__construct('localhost', 'root', '', 'api_rest');
        $this->set_charset('utf8');
        $this->connect_error == NULL ? 'Conexión exitosa a la BD' : die('Error en la conexión a la BD');
    }//end_construct
}//end_class

// Crear una instancia de la clase Connection
$conexion = new Connection();

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// realizar consultas a la base de datos
$sql = "SELECT * FROM clientes AS c LIMIT 10";
$result = $conexion->query($sql);

// Utilizar la función mysqli_fetch_all() para devolver los datos en una matriz
$clientes = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Cerrar la conexión
$conexion->close();
