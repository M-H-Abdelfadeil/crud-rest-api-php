<?php
include '../../app/header.php';

use App\Controllers\AuthController;

forceHttpMethod("POST");

$auth= new AuthController;

return $auth->login();

