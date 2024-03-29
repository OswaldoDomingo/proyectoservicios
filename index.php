<?php
//index.php
// Se inicia la sesión para poder acceder a las variables de sesión y poder cerrarla cuando se desee cerrar sesión 
//o cuando se cierre el navegador (por defecto).
session_start();
// Detectar si se está ejecutando en local
if ($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
    // Entorno local
    $configFilePath = __DIR__ . '/../proyectoservicios/utils/config.php';
} else {
    // Asumir que cualquier otro caso es producción
    $configFilePath = __DIR__ . '/../proyectoservicios/utils/ConfigServer.php';
}

// Verificar si el archivo de configuración existe
if (!file_exists($configFilePath)) {
    die("El archivo de configuración no existe: {$configFilePath}");
}

// Cargar el archivo de configuración
require_once($configFilePath);


// Se incluye el fichero de configuración. 
// require_once ( __DIR__ . '/../proyectoservicios/utils/Config.php');
require_once ( __DIR__ . '/../proyectoservicios/controller/home.php');
require_once ( __DIR__ . '/../proyectoservicios/controller/cLogin.php');
require_once ( __DIR__ . '/../proyectoservicios/controller/cRegistro.php');
require_once ( __DIR__ . '/../proyectoservicios/controller/cListado.php');
require_once ( __DIR__ . '/../proyectoservicios/utils/bGeneral.php');
require_once ( __DIR__ . '/../proyectoservicios/utils/rutas.php');





/*
Si el usuario todavia no está logueado lo identificamos como visitante, por ejemplo de la siguiente manera: $_SESSION['nivel_usuario']=0
*/
if (!isset($_SESSION['nivel_usuario'])) {
    $_SESSION['nivel_usuario'] = 0;
}

//COPIADO DE HEIKE
//Enrutamiento
$map = array(
    /*
    nivel_usuario se encargará de controlar el acceso a las páginas que requieran un nivel de usuario determinado.
    'inicio' => array('controller' =>'Controller', 'action' =>'inicio', 'nivel_usuario'=>0)
    */
    'inicio' => array('controller' => 'Home', 'action' => 'inicio', 'nivel_usuario'=>0),
    'registro' => array('controller' => 'Registro', 'action' => 'registro', 'nivel_usuario'=>0),
    'login' => array('controller' => 'Login', 'action' => 'login', 'nivel_usuario'=>0),
    'listado' => array('controller' => 'Listado', 'action' => 'listado', 'nivel_usuario'=>0),
);


// Parseo de la ruta
if (isset($_GET['page'])) {
    if (isset($map[$_GET['page']])) {
        $ruta = $_GET['page'];
    } else {
        //Si el valor puesto en page en la URL no existe en el array de mapeo envía una cabecera de error
        header('Status: 404 Not Found');
        echo '<html><body><h1>Error 404: No existe la ruta <i>' .
            $_GET['page'] . '</p></body></html>';
        exit;
    }
} else {
    $ruta = 'inicio';
}

$controlador = $map[$ruta];
//  
if (method_exists($controlador['controller'], $controlador['action'])) {
    call_user_func(array(
        new $controlador['controller'],
        $controlador['action']
    ));
} else {
    header('Status: 404 Not Found');
    echo '<html><body><h1>Error 404: El controlador <i>' .
        $controlador['controller'] .
        '=>' .
        $controlador['action'] .
        '</i> no existe</h1></body></html>';
}
//FIN COPIADO DE HEIKE
?>