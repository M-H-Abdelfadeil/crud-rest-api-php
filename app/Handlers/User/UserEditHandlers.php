<?php
namespace App\Handlers\User;
use App\Handlers\Handler;
use Firebase\JWT\JWT;
class UserEditHandlers extends Handler{
    public function edit($model){
       // check requests
       $needed_requests=['token'];
       $data_not_found=not_found_data($needed_requests);
       if($data_not_found){
           $msg="The data you have sent is incomplete. Add the data ( ".implode(' - ', $data_not_found) . ' )';
           return res_json(0,$msg);
       }
       
        try{
            $data_decode=JWT::decode($_POST['token'],SECRET_TOKEN,[HASH_TOKEN]);
            $id= $data_decode->data_user->id;
            return $this->execute_edit($model,$id);
           
        }catch(\Exception $e){
            return res_json(0,$e->getMessage());
        }

    }


    public function execute_edit($model,$id){
        $data=$model->edit($id);
        if($data){
           return  res_json(1,'success',$data);
        }else{
            $msg="This edit profile cannot be displayed. Perhaps the ID number is wrong or you do not have permission to edit";
            return  res_json(0,$msg); 
        }
    }
}