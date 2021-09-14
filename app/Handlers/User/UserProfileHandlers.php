<?php
namespace App\Handlers\User;
use App\Handlers\Handler;

class UserProfileHandlers extends Handler{
    public function profile($model){
         // check requests
         $needed_requests=['id_user'];
         $data_not_found=not_found_data($needed_requests);
         if($data_not_found){
             $msg="The data you have sent is incomplete. Add the data ( ".implode(' - ', $data_not_found) . ' )';
             return res_json(0,$msg);
         }
         // check validate
         $has_error=$this->validate_profile();
         if($has_error){
             return res_json(0,'error validate',$has_error);
         }else{
             return $this->execute_profile($model);
         }
    }


    private function validate_profile(){
        $rules=[
            'id_user'=>'required|number',
        ];
        $valiadte=$this->validate->Validator($rules);
        return $this->validate->has_error_validate();
    }

    private function execute_profile($model){
        $id_user=$this->filter->num_int($_REQUEST['id_user']);
        $data=$model->profile($id_user);
        if($data){
            return res_json(1,'success',$data);
        }else{
            return res_json(0,'View Profile Failed');  
        }

    }
}