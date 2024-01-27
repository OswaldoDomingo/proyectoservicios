<?php
class Registro{
    public function __construct(){
        //controller/cLogin.php
        $title = Config::$title = 'Registro';
        
        
        require('view/vRegistro.php');

    }    

}
?>