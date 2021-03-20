<?php

include '../../app/header.php';

use App\Controllers\PostController;

$post=new PostController();

return $post->delete();