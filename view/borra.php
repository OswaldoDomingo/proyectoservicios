<?php
$map = array(
    /*
    En cada elemento podemos añadir una posición mas que se encargará de otorgar el nivel mínimo para ejecutar la acción
    Puede quedar de la siguiente manera
    'inicio' => array('controller' =>'Controller', 'action' =>'inicio', 'nivel_usuario'=>0)
    */
    'inicio' => array('controller' => 'Controller', 'action' => 'inicio'),
    'listar' => array('controller' => 'Controller', 'action' => 'listar'),
    'insertar' => array('controller' => 'Controller', 'action' => 'insertar'),
    'buscar' => array('controller' => 'Controller', 'action' => 'buscarPorNombre'),
    'ver' => array('controller' => 'Controller', 'action' => 'ver'),
    'error' => array('controller' => 'Controller', 'action' => 'error')
);
$_GET['ctl'] = 'insertar';
// Parseo de la ruta
if (isset($_GET['ctl'])) {
    if (isset($map[$_GET['ctl']])) {
        $ruta = $_GET['ctl'];
    } else {

        //Si el valor puesto en ctl en la URL no existe en el array de mapeo envía una cabecera de error
        header('Status: 404 Not Found');
        echo '<html><body><h1>Error 404: No existe la ruta <i>' .
            $_GET['ctl'] . '</p></body></html>';
        exit;
    }
} else {
    $ruta = 'inicio';
}
var_dump($ruta);

echo '<br>';

$controlador = $map[$ruta];
var_dump($controlador);

if (method_exists($controlador['controller'], $controlador['action'])) {
    call_user_func(array(
        new $controlador['controller'],
        $controlador['action']
    ));
} else {
    header('Status: 404 Not Found');
    echo '<html><body><h1>Error 404: El controlador <i>' .
        $controlador['controller'] .
        ' ==> ' .
        $controlador['action'] .
        '</i> no existe</h1></body></html>';
}
?>