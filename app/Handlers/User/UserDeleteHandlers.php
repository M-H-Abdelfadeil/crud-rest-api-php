<?php
namespace App\Handlers\User;
use App\Handlers\Handler;
use Firebase\JWT\JWT;
class UserDeleteHandlers extends Handler{
    public function delete($model){
       // check requests
       $nedded_requests=['token'];
       $data_not_found=notfound_data($nedded_requests);
       if($data_not_found){
           $msg="The data you have sent is incomplete. Add the data ( ".implode(' - ', $data_not_found) . ' )';
           return res_jsone(0,$msg);
       }

        $has_error=$this->validate_update_password();
        if($has_error){
            return res_jsone(0,'error validate',$has_error);
        }
       
        try{
            $data_decode=JWT::decode($_POST['token'],SECRET_TOKEN,[HASH_TOKEN]);
            $id= $data_decode->data_user->id;
            return $this->execute_delete($model,$id);
        }catch(\Exception $e){
            return res_jsone(0,$e->getMessage());
        }

    }

    private function execute_delete($model,$id){
        $model->delete($id);
        return res_jsone(1,'Your account has been successfully deleted');
        
    }


    private function validate_update_password(){
        $rules=[
            'token'=>'required',
        ];
        $valiadte=$this->validate->Validator($rules);
        return $this->validate->has_error_validate();
    }
}