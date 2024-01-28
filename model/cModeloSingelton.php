<?php
class ModeloSingelton
{
    // Atributo que almacena la única instancia de la clase
    private static $instance = null;
    // Atributo que almacena la conexión con la base de datos
    protected $conexion;

    private function __construct()
    {
        $this->conexion = new PDO('mysql:host=' . Config::$hostname . ';dbname=' . Config::$dbname, Config::$usuario, Config::$clave);
        // Realizar el enlace con la base de datos con utf8 para que no haya problemas con los acentos y caracteres especiales españoles
        $this->conexion->exec("set names utf8");
        // Establecer el modo de error a excepción para que salte un error cuando se produzca
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Método para obtener la única instancia de la clase
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new ModeloSingelton();
        }
        return self::$instance;
    }

    // Método para obtener la conexión a la base de datos
    public function getConexion()
    {
        return $this->conexion;
    }

    public function obtenerServicios()
    {
        $servicios = [];
        $sql = "SELECT titulo, descripcion, precio FROM servicios";

        try {
            $stmt = $this->conexion->query($sql);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $servicios[] = $row;
            }
        } catch (PDOException $e) {
            // Manejar excepción
            error_log("Error en la consulta SQL: " . $e->getMessage());
            // Retornar un array vacío o manejar el error de manera adecuada
        }

        return $servicios;
    }
}

// Ejemplo de uso:
// $modelo = ModeloSingleton ::getInstance();
// $conexion = $modelo->getConexion();
