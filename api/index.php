<!DOCTYPE html>
<html>
<head>
    <title>CLIENTES</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>LISTA DE CLIENETS</h1>

        <!-- Formulario para crear un nuevo cliente -->

        <h2>Crear Cliente</h2>
        <form id="create-client-form">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" required><br>
            <label for="ap">Apellido Paterno:</label>
            <input type="text" name="ap" required><br>
            <label for="am">Apellido Materno:</label>
            <input type="text" name="am" required><br>
            <label for="fn">Fecha de Nacimiento:</label>
            <input type="date" name="fn" required><br>
            <label for="genero">Género:</label>
            <select name="genero">
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
                <option value="Otro">Otro</option>
            </select><br>
            <input type="submit" value="Crear">
        </form>

        <!-- Lista de Clientes -->

        <h2>Lista de clientes</h2>
        <ul id="client-list">
            <!-- Aquí se mostrará la lista de clientes -->
        </ul>

        <!-- Formulario para editar un cliente (inicialmente oculto) -->

        <h2>Editar Cliente</h2>
        <form id="edit-client-form" style="display: none;">
            <input type="hidden" id="edit-client-id" name="id">
            <label for="nombre">Nombre:</label>
            <input type="text" id="edit-nombre" name="nombre" required><br>
            <label for="ap">Apellido Paterno:</label>
            <input type="text" id="edit-ap" name="ap" required><br>
            <label for "am">Apellido Materno:</label>
            <input type="text" id="edit-am" name="am" required><br>
            <label for="fn">Fecha de Nacimiento:</label>
            <input type="date" id="edit-fn" name="fn" required><br>
            <label for="genero">Género:</label>
            <select id="edit-genero" name="genero">
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
                <option value="Otro">Otro</option>
            </select><br>
            <input type="submit" value="Guardar Cambios">
        </form>
    </div>

    <script src="js/script.js"></script>
</body>
</html>
