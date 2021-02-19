<?php
include '../../app/header.php';

use App\Controllers\AuthController;

$auth= new AuthController;

return $auth->login();

