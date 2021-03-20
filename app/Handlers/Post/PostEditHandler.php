<?php
namespace App\Handlers\Post;
use App\Handlers\Handler;
use Firebase\JWT\JWT;

class PostEditHandler extends Handler{

    public function edit($model){
        // check requests
        $nedded_requests=['token','id_post'];
        $data_not_found=notfound_data($nedded_requests);
        if($data_not_found){
            $msg="The data you have sent is incomplete. Add the data ( ".implode(' - ', $data_not_found) . ' )';
            return res_jsone(0,$msg);
        }
        // check validate
        $has_error=$this->validate_edit();
        if($has_error){
            return res_jsone(0,'error validate',$has_error);
        }
        // get user id 
        try{
            $data_decode=JWT::decode($_POST['token'],SECRET_TOKEN,[HASH_TOKEN]);
            $id_user=$data_decode->data_user->id;
            return $this->get_post($model,$id_user);
        }catch(\Exception $e){
            return res_jsone(0,$e->getMessage());
        }



        
    }

   
    private function validate_edit(){
        $rules=[
            'id_post'=>'required|number',
            'token'=>'required'
        ];
        $this->validate->Validator($rules);
        return $this->validate->has_error_validate();
        
    }

    public function get_post($model,$id_user){
        $id_post=$this->filter->num_int($_REQUEST['id_post']);
        $data=$model->edit($id_user,$id_post);
        if($data){
           return  res_jsone(1,'success',$data);
        }else{
            $msg="editing the post failed because it does not exist or you do not have permission to edit it";
            return  res_jsone(0,$msg); 
        }
    }
}