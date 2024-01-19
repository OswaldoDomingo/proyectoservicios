<?php
// Se inicia la sesión para poder acceder a las variables de sesión y poder cerrarla cuando se desee cerrar sesión 
//o cuando se cierre el navegador (por defecto).
session_start();
// Se incluye el fichero de configuración. 
require('utils/Config.php');

// Se incluye el modelo de la base de datos que se va a utilizar.
require ('model/cModeloSingelton.php');
$modelo = ModeloSingelton::getInstance();
$conexion = $modelo->getConexion();

/*
Si el usuario todavia no está logueado lo identificamos como visitante, por ejemplo de la siguiente manera: $_SESSION['nivel_usuario']=0
*/
if (!isset($_SESSION['nivel_usuario'])) {
    $_SESSION['nivel_usuario'] = 0;
}

//Enrutamiento
$map = array(
    /*
    nivel_usuario se encargará de controlar el acceso a las páginas que requieran un nivel de usuario determinado.
    'inicio' => array('controller' =>'Controller', 'action' =>'inicio', 'nivel_usuario'=>0)
    */
    'inicio' => array('controller' => 'Controller', 'action' => 'inicio', 'nivel_usuario'=>0),
    'listar' => array('controller' => 'Controller', 'action' => 'listar', 'nivel_usuario'=>0),
    'insertar' => array('controller' => 'Controller', 'action' => 'insertar', 'nivel_usuario'=>2),
    'buscar' => array('controller' => 'Controller', 'action' => 'buscarPorNombre', 'nivel_usuario'=>1),
    'ver' => array('controller' => 'Controller', 'action' => 'ver', 'nivel_usuario'=>1),
    'error' => array('controller' => 'Controller', 'action' => 'error', 'nivel_usuario'=>0)
);

$page = (isset($_GET['page'])) ? $_GET['page'] : 'home';

switch ($page) {
    case 'home':
        require('controller/home.php');
        break;
    case 'login':
        require('controller/cLogin.php');
        break;
    default:
        require('controller/home.php');
}
