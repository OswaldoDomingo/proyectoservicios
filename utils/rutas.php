<?php
// config/rutas.php
// Configuración para el entorno local
if ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['REMOTE_ADDR'] === '127.0.0.1') {
    define('BASE_URL', 'http://proyectoservicios.test');
} else {
    // Configuración para el entorno de producción
    define('BASE_URL', 'https://oswaldodomingo.com/proyectoservicios/');
}

// Puedes añadir aquí más rutas o URLs relacionadas, como rutas a directorios específicos
