<?php
class Login{
    public function __construct(){
        //controller/cLogin.php
        $title = Config::$title = 'Login';

        require('view/vLogin.php');

    }
}
