<!DOCTYPE html>
<html>

<head>
    <title>Calculadora</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Calculadora</h2>
        <form method="post" action="cliente.php">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="num1">Número 1:</label>
                    <input type="number" class="form-control" name="num1" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="num2">Número 2:</label>
                    <input type="number" class="form-control" name="num2" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="operacion">Operación:</label>
                    <select class="form-control" name="operacion">
                        <option value="suma">Suma</option>
                        <option value="resta">Resta</option>
                        <option value="multiplicacion">Multiplicación</option>
                        <option value="division">División</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="calcular">Calcular</button>
        </form>

        <div class="result">
            <?php
            if (isset($_POST['calcular'])) {
                $num1 = $_POST['num1'];
                $num2 = $_POST['num2'];
                $operacion = $_POST['operacion'];

                $options = array(
                    'location' => 'http://localhost/calculadora/server.php',
                    'uri' => 'http://localhost/calculadora/server.php',
                );

                try {
                    $client = new SoapClient(NULL, $options);

                    if ($operacion === 'suma') {
                        $resultado = $client->suma($num1, $num2);
                    } elseif ($operacion === 'resta') {
                        $resultado = $client->resta($num1, $num2);
                    } elseif ($operacion === 'multiplicacion') {
                        $resultado = $client->multiplicacion($num1, $num2);
                    } elseif ($operacion === 'division') {
                        if ($num2 != 0) {
                            $resultado = $client->division($num1, $num2);
                        } else {
                            echo "No se puede dividir por cero.";
                        }
                    }

                    echo "Resultado: $resultado";
                } catch (SoapFault $e) {
                    echo "Error: " . $e->getMessage();
                }
            }
            ?>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
