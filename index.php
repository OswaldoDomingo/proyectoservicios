<?php
session_start();

$page = (isset($_GET['page'])) ? $_GET['page'] : 'home';

switch ($page) {
    case 'home':
        require('controller/home.php');
        break;
    default:
        require('controller/home.php');
}
