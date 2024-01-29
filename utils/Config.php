<?php
class Config{
    //Título de la página	
    static public $title;
    //Datos de la base de datos
    static public $hostname = 'localhost';
    static public $dbname = 'evaluable_7w';
    static public $clave = 'kali';
    static public $usuario = 'root';

     // Ruta base para imágenes
     public static $rutaBaseImg;

     public static function inicializar() {
         // Determinar si el entorno es de desarrollo local o producción
         if ($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '127.0.0.1') {
             // Ruta para entorno local
             self::$rutaBaseImg = $_SERVER['DOCUMENT_ROOT'] . '/miProyecto/public/img/';
         } else {
             // Ruta para entorno de producción
             self::$rutaBaseImg = $_SERVER['DOCUMENT_ROOT'] . '/public/img/';
         }
     }

}

?>