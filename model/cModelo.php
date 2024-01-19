<?php
class Modelo extends PDO{
    //Atributo que almacena la conexión con la base de datos.
    protected $conexion;

    public function __construct(){
        $this->conexion = new PDO('mysql:host=' . Config::$hostname . ';dbname = ' . Config::$dbname . '',Config::$usuario, Config::$clave);
        //Realizar el enlace con la base de datos con utf8 para que no haya problemas con los acentos y caracteres especiales españoles.
        $this->conexion->exec("set names utf8");
        //Establecer el modo de error a excepción para que salte un error cuando se produzca.
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }
    
}

?>