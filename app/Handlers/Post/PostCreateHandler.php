<?php
namespace App\Handlers\Post;
use App\Handlers\Handler;
use Firebase\JWT\JWT;


class PostCreateHandler extends Handler{
    public function create($model){
        $nedded_requsts=['token','title','description'];
        $data_not_found=not_found_data($nedded_requsts);
        if($data_not_found){
            $msg="The data you have sent is incomplete. Add the data ( ".implode(' - ', $data_not_found) . ' )';
            return res_json(0,$msg);
        }

        try{
            $data_decode=JWT::decode($_POST['token'],SECRET_TOKEN,[HASH_TOKEN]);
            $has_error=$this->validate_create();
            if($has_error){
                return res_json(0,'error validate',$has_error);
            }else{
               $id= $data_decode->data_user->id;
               $this->execute_create($model,$id);
            }
        }catch(\Exception $e){
            return res_json(0,$e->getMessage());
        }
    }


    private function execute_create($model,$user_id){
        $title=$this->filter->string($_REQUEST['title']);
        $desription=$this->filter->string($_REQUEST['description']);
        $id=$model->create($title,$desription,$user_id);
        $data=[
            'post_id'=>$id,
            'user_id'=>$user_id,
            'title'=>$title,
            'desription'=>$desription,
        ];
        return res_json(1,'success add post',$data);
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