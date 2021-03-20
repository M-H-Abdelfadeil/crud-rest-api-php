<?php
namespace App\Handlers\Post;

class PostIndexHandler{
    public function index($model){

        return res_jsone(1,'success',$this->get_posts($model));
        
    }

    public function get_posts($model){
        $data= $model->index();
        if($data){
            return $data;
        }else{
           return [];
        }
    }
}