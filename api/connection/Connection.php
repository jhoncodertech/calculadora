<?php

class Connection extends Mysqli {
    function __construct() {
        parent::__construct('Localhost','root','','api_rest');
        $this->set_charset('utf8');
        $this->connect_error == NULL ? 'Conexión exítosa a la BD' : die('Error en la conexión a la BD');
    }//end_construct
}//end_class