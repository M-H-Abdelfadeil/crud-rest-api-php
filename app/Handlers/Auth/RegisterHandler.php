<?php
namespace App\Handlers\Auth;
use App\Handlers\Handler;

class RegisterHandler extends Handler{
    
    public  function register($model)
    {
        $nedded_requests=['name','email','password'];
        $data_not_found=notfound_data($nedded_requests);
        if($data_not_found){
            $msg="The data you have sent is incomplete. Add the data ( ".implode(' - ', $data_not_found) . ' )';
            return res_jsone(0,$msg);
        }

        $has_error=$this->validate_register();
        if($has_error){
            return res_jsone(0,'error validate',$has_error);
        }else{
            $data=$this->execute_register($model);
            return res_jsone(1,'success',$data);

        }
    }

    public function execute_register($model){
        $name    =$this->filter->string($_REQUEST['name']);
        $email   =$this->filter->email($_REQUEST['email']);
        $password=$this->filter->string($_REQUEST['password']);
        $password=password_hash($password,PASSWORD_DEFAULT);

        $id= $model->register($name,$email,$password);
        if($id){
            return [
                'id'=>$id,
                'name'=>$name,
                'email'=>$email,

            ];
        }
    }



    private function validate_register(){
        $rules=[
            'name'=>'required|string|max_length:100',
            'email'=>'required|email|max_length:255|unique:users,email',
            'password'=>'required|string|min_length:8'
        ];
        $this->validate->Validator($rules);
        return $this->validate->has_error_validate();
    }
}