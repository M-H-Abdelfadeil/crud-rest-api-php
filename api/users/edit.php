<?php
include '../../app/header.php';

use App\Controllers\UserController;

$user=new UserController();

return $user->edit();

