<?php
require_once "../connection/Connection.php";

class Api {
    private $conexion;

    public function __construct() {
        $this->conexion = new Connection();
    }

    public function getAll() {
        $sql = "SELECT * FROM clientes";
        $result = $this->conexion->query($sql);
        $clientes = $result->fetch_all(MYSQLI_ASSOC);
        return $clientes;
    }

    public function postCliente($nombre, $ap, $am, $fn, $genero) {
        $nombre = $this->conexion->real_escape_string($nombre);
        $ap = $this->conexion->real_escape_string($ap);
        $am = $this->conexion->real_escape_string($am);
        $fn = $this->conexion->real_escape_string($fn);
        $genero = $this->conexion->real_escape_string($genero);
        
        $sql = "INSERT INTO clientes (nombre, ap, am, fn, genero) VALUES ('$nombre', '$ap', '$am', '$fn', '$genero')";
        $this->conexion->query($sql);
        return $this->conexion->insert_id;
    }

    public function putCliente($id, $nombre, $ap, $am, $fn, $genero) {
        $id = (int)$id;
        $nombre = $this->conexion->real_escape_string($nombre);
        $ap = $this->conexion->real_escape_string($ap);
        $am = $this->conexion->real_escape_string($am);
        $fn = $this->conexion->real_escape_string($fn);
        $genero = $this->conexion->real_escape_string($genero);

        $sql = "UPDATE clientes SET nombre = '$nombre', ap = '$ap', am = '$am', fn = '$fn', genero = '$genero' WHERE id = $id";
        $this->conexion->query($sql);
        return $this->conexion->affected_rows;
    }

    public function deleteCliente($id) {
        $id = (int)$id;
        $sql = "DELETE FROM clientes WHERE id = $id";
        $this->conexion->query($sql);
        return $this->conexion->affected_rows;
    }
}

$api = new Api();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $response = $api->getAll();
    echo json_encode($response);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if ($data) {
        $nombre = $data['nombre'];
        $ap = $data['ap'];
        $am = $data['am'];
        $fn = $data['fn'];
        $genero = $data['genero'];
        $response = $api->postCliente($nombre, $ap, $am, $fn, $genero);
        echo json_encode(['id' => $response]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    if ($data && isset($data['id'])) {
        $id = $data['id'];
        $nombre = $data['nombre'];
        $ap = $data['ap'];
        $am = $data['am'];
        $fn = $data['fn'];
        $genero = $data['genero'];
        $response = $api->putCliente($id, $nombre, $ap, $am, $fn, $genero);
        echo json_encode(['filas_afectadas' => $response]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $response = $api->deleteCliente($id);
        echo json_encode(['filas_afectadas' => $response]);
    }
} else {
    header("HTTP/1.0 405 Method Not Allowed");
}
