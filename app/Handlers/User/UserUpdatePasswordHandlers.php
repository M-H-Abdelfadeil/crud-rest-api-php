<?php
namespace App\Handlers\User;
use App\Handlers\Handler;
use Firebase\JWT\JWT;
class UserUpdatePasswordHandlers extends Handler{
    public function updatePassword($model){
       // check requests
       $nedded_requests=['token','old_password','new_password'];
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
            $chk_pass= $this->chk_old_password($model,$id);
           if(!$chk_pass){
               return res_jsone(0,'The old password is wrong');
           }
           return $this->execute_update_password($model,$id);
        }catch(\Exception $e){
            return res_jsone(0,$e->getMessage());
        }

    }

    private function chk_old_password($model,$id){
        $data=$model->get_old_password($id);
        $old_password=$this->filter->string($_REQUEST['old_password']);
        if(password_verify( $old_password,$data['password'])){
            return true;
        }
        return false ;
    }

    private function execute_update_password($model,$id){
        $new_password=$this->filter->string($_REQUEST['new_password']);
        $new_password=password_hash($new_password,PASSWORD_DEFAULT);
        $model->update_password($id,$new_password);
        return res_jsone(1,'Password has been successfully updated');
        
    }


    private function validate_update_password(){
        $rules=[
            'token'=>'required',
            'old_password'=>'required',
            'new_password'=>'required|string|min_length:8'
        ];
        $valiadte=$this->validate->Validator($rules);
        return $this->validate->has_error_validate();
    }
}