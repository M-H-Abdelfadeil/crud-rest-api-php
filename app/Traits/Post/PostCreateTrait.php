<?php
namespace App\Traits\Post;

use Firebase\JWT\JWT;


trait PostCreateTrait{

    public function handler_create(){
        try{
            $data_decode=JWT::decode($_POST['token'],SECRET_TOKEN,[HASH_TOKEN]);
            $has_error=$this->validate_create();
            if($has_error){
                return res_jsone(0,'error validate',500,$has_error);
            }else{
               $id= $data_decode->data_user->id;
               $this->execute_create($id);
            }
        }catch(\Exception $e){
            return res_jsone(0,$e->getMessage(),500);
        }
    }


    private function execute_create($user_id){
        $title=$this->filter->string($_REQUEST['title']);
        $desription=$this->filter->string($_REQUEST['description']);
        $id=$this->model()->create($title,$desription,$user_id);
        $data=[
            'post_id'=>$id,
            'user_id'=>$user_id,
            'title'=>$title,
            'desription'=>$desription,
        ];
        return res_jsone(1,'success add post',200,$data);
    }

    private function validate_create(){
        $rules=[
            'title'=>'required|string|max_length:100',
            'description'=>'required|string|max_length:1000'
        ];
        $valiadte=$this->validate->Validator($rules);
        return $this->validate->has_error_validate();
    }

}