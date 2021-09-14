<?php
namespace App\Handlers\User;
use App\Handlers\Handler;
use Firebase\JWT\JWT;
class UserUpdateHandlers extends Handler{
    public function update($model){
       // check requests
       $needed_requests=['token','name','email'];
       $data_not_found=not_found_data($needed_requests);
       if($data_not_found){
           $msg="The data you have sent is incomplete. Add the data ( ".implode(' - ', $data_not_found) . ' )';
           return res_json(0,$msg);
       }

        $has_error=$this->validate_update();
        if($has_error){
            return res_json(0,'error validate',$has_error);
        }
       
        try{
            $data_decode=JWT::decode($_POST['token'],SECRET_TOKEN,[HASH_TOKEN]);
            $id= $data_decode->data_user->id;
            return $this->execute_update($model,$id);
           
        }catch(\Exception $e){
            return res_json(0,$e->getMessage());
        }

    }


    private function execute_update($model,$id){
        $name=$this->filter->string($_REQUEST['name']);
        $email=$this->filter->string($_REQUEST['email']);
        $data=$model->update($id,$name,$email);
        if($data){
           return  res_json(1,'Successfully updated');
        }else{
            $msg="This profile cannot be updated. Perhaps the ID number is wrong or you do not have permission to modify it";
            return  res_json(0,$msg); 
        }
    }


    private function validate_update(){
        $rules=[
            'name'=>'required|string|max_length:100',
            'email'=>'required|email|max_length:255'
        ];
        $valiadte=$this->validate->Validator($rules);
        return $this->validate->has_error_validate();
    }
}