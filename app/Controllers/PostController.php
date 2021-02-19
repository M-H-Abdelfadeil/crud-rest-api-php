<?php
namespace App\Controllers;
use App\Controllers\Controller;
use App\Traits\Post\PostCreateTrait;
use App\Models\PostModel;

class PostController extends Controller{

    use PostCreateTrait;
    public function model(){
        return new PostModel;
    }
    public function create(){
        $nedded_requsts=['token','title','description'];
        $data_not_found=notfound_data($nedded_requsts);
        if($data_not_found){
            $msg="The data you have sent is incomplete. Add the data ( ".implode(' - ', $data_not_found) . ' )';
            return res_jsone(0,$msg,200);
        }else{
            return $this->handler_create();
        }
    }

}