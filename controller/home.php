<?php
class Home{
    public function inicio(){
        $title = Config::$title = 'Inicio';
        
        require('view/home.php');
    
    }
}
?>