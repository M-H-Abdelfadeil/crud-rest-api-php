<?php
include '../../app/header.php';

use App\Controllers\AuthController;

$auth= new AuthController;

echo $auth->login();

