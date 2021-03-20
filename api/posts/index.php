<?php
include '../../app/header.php';
use App\Controllers\PostController;

$posts= new PostController;

return $posts->index();