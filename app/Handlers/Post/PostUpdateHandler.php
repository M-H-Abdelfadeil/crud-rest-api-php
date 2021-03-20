<?php
namespace App\Handlers\Post;
use App\Handlers\Handler;
use Firebase\JWT\JWT;

class PostUpdateHandler extends Handler{
    public function  update($model){
        // check requests
        $nedded_requests=['token','id_post','title','description'];
        $data_not_found=notfound_data($nedded_requests);
        if($data_not_found){
            $msg="The data you have sent is incomplete. Add the data ( ".implode(' - ', $data_not_found) . ' )';
            return res_jsone(0,$msg);
        }
        // check validate
        $has_error=$this->validate_update();
        if($has_error){
            return res_jsone(0,'error validate',$has_error);
        }
        // get user id 
        try{
            $data_decode=JWT::decode($_POST['token'],SECRET_TOKEN,[HASH_TOKEN]);
            $id_user=$data_decode->data_user->id;
            return $this->execute_update($model,$id_user);
        }catch(\Exception $e){
            return res_jsone(0,$e->getMessage());
        }
    }


    private function validate_update(){
        $rules=[
            'token'=>'required',
            'id_post'=>'required|number',
            'title'=>'required|string|max_length:100',
            'description'=>'required|string|max_length:1000'
        ];
        $valiadte=$this->validate->Validator($rules);
        return $this->validate->has_error_validate();
    }

    private function execute_update($model,$id_user){
        $title=$this->filter->string($_REQUEST['title']);
        $desription=$this->filter->string($_REQUEST['description']);
        $id_post=$this->filter->num_int($_REQUEST['id_post']);
 
        $update=$model->update($id_user,$id_post,$title,$desription);
        if($update){
            return  res_jsone(1,'Successfully updated');
        }else{
            $msg="Post failed to update, perhaps an invalid ID number, or you do not have permission to update it";
            return  res_jsone(0,$msg); 
        }
    }
}