<?php
ini_set("display_errors", 1);
include '../../app/header.php';

use App\Controllers\AuthController;
$auth= new AuthController;
return $auth->register();








