<?php
namespace App\Traits;

trait RegisterTrait{
    public function handler_register(){
        $has_error=$this->validate_register();
        if($has_error){
            return res_jsone(0,'error validate',500,$has_error);
        }else{
            $data=$this->execute_register();
            return res_jsone(1,'success',200,$data);

        }
    }

    public function execute_register(){
        $name    =$this->filter->string($_REQUEST['name']);
        $email   =$this->filter->email($_REQUEST['email']);
        $password=$this->filter->string($_REQUEST['password']);
        $password=password_hash($password,PASSWORD_DEFAULT);

        $id= $this->model->register($name,$email,$password);
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