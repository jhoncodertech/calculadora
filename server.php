<?php
class CalculadoraSOAP {
    public function suma($num1, $num2){
        return $num1 + $num2;
    }

    public function resta($num1, $num2){
        return $num1 - $num2;
    }

    public function multiplicacion($num1, $num2){
        return $num1 * $num2;
    }

    public function division($num1, $num2){
        if($num2 != 0) {
            return $num1 / $num2;
        } else {
            throw new SoapFault("Server", "No se puede dividir por cero.");
        }
    }
}

$options = array('uri' => 'http://localhost/calculadora/server.php'); 
$Server = new SoapServer('calcularwsdl.wsdl', $options);
$Server->setClass('CalculadoraSOAP');
$Server->handle();
?>
