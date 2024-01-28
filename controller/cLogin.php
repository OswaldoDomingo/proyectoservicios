<?php
class Login{
    public function login(){
        //controller/cLogin.php
        $title = Config::$title = 'Login';

        require('view/vLogin.php');

    }
}
