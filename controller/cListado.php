<?php
//Listar los registros de la tabla servicios
class Listado {
    public function listado() {
        $modelo = ModeloSingelton::getInstance();
        $servicios = $modelo->obtenerServicios(); // Obtiene los servicios
        $title = Config::$title = 'Listado de servicios';

        require('view/vListado.php'); // Pasa los servicios a la vista
    }
}
