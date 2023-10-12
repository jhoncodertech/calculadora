<?php
require_once "models/Cliente.php";

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['id'])) {
            echo json_encode(Cliente::getWhere($_GET['id']));

        } //end if
        else {
            ?>
            <table>
            <tr style="padding: 20px;">
                <th>Nombre</th>
                <th>Apellido 1</th>
                <th>Apellido 2</th>
                <th>Fecha Nacimiento</th>
                <th>Genero</th>
                <th>Acciones</th>
            </tr>
            <?php
            $xd = Cliente::getAll();
            foreach ($xd as $x) {
                ?>               
                    <tr>
                        <td><?php echo $x['nombre']; ?></td>
                        <td><?php echo $x['apellido_1']; ?></td>
                        <td><?php echo $x['apellido_2']; ?></td>
                        <td><?php echo $x['fecha_nacimiento']; ?></td>
                        <td><?php echo $x['genero']; ?></td>
                        <td><a href="">editar</a></td>
                        <td><a href="">eliminar</a></td>
                    </tr>
                
                
                <?php
            }
            ?>
            </table>
            <?php
        } //end else
        break;

    case 'POST':
        $datos = json_decode(file_get_contents('php://input'));
        if ($datos != NULL) {
            if (Cliente::insert($datos->nombre, $datos->apellido_1, $datos->apellido_2, $datos->fecha_nacimiento, $datos->genero)) {
                http_response_code(200);
            } //end if
            else {
                http_response_code(400);
            } //end else
        } //end if
        else {
            http_response_code(405);
        } //end else
        break;

    case 'PUT':
        $datos = json_decode(file_get_contents('php://input'));
        if ($datos != NULL) {
            if (Cliente::update($datos->id, $datos->nombre, $datos->apellido_1, $datos->apellido_2, $datos->fecha_nacimiento, $datos->genero)) {
                http_response_code(200);
            } //end if
            else {
                http_response_code(400);
            } //end else
        } //end if
        else {
            http_response_code(405);
        } //end else
        break;

    case 'DELETE':
        if (isset($_GET['id'])) {
            if (Cliente::delete($_GET['id'])) {
                http_response_code(200);
            } //end if
            else {
                http_response_code(400);
            } //end else
        } //end if 
        else {
            http_response_code(405);
        } //end else
        break;

    default:
        http_response_code(405);
        break;
} //end while