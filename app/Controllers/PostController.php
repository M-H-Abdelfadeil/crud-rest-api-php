<?php
namespace App\Controllers;
use App\Handlers\Post\PostCreateHandler;
use App\Handlers\Post\PostIndexHandler;
use App\Handlers\Post\PostShowHandler;
use App\Models\PostModel;

class PostController {


    public function create(){
        $create=new PostCreateHandler;
        $create->create(new PostModel);
    }

    public function index(){
        $index=new PostIndexHandler;
        return $index->index(new PostModel);
    }

    public function show(){
        $show=new PostShowHandler;
        return $show->show(new PostModel);
    }

}