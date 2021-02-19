<?php
namespace App\Traits;

use Firebase\JWT\JWT;


trait LoginTrait{

    public function handler_login(){
        $has_error=$this->validate_login();
        if($has_error){
            return res_jsone(0,'error validate',500,$has_error);
        }else{
            $this->execute_login();
        }
    }


    public function execute_login(){
        $email   =$this->filter->email($_REQUEST['email']);
        $password=$this->filter->string($_REQUEST['password']);
        $data=$this->model->login($email);
        if(!$data){
            return res_jsone(0 , 'The email and password do not match' , 200 );
        }else{
          $chk_pass= $this->check_password($password,$data['password']);
          if($chk_pass){
            $data_user=$this->set_token($data);  
            return res_jsone(1,'success login',200, $data_user);
          }else{
            return res_jsone(0 , 'The email and password do not match' , 200 );
          }
        }
       
        
    }

    public function check_password($password,$password_hash){
       if(password_verify($password,$password_hash)){
           return true;
       }else{
           return false;
       }

    }


    private function set_token($data){
        $data_user=[
            'id'=>$data['id'],
            'name'=>$data['name'],
            'email'=>$data['email'], 
        ];
        $payload=[
            'iss'=>Host,
            'iat'=>time(),
            'exp'=>time()+3600,
            'aud'=>'usersApi',
            'data'=>$data_user,

        ];

        $token=JWT::encode($payload,SECRET_TOKEN,HASH_TOKEN);
        $data_user['token']=$token;
        return  $data_user;
    }


    private function validate_login(){
        $rules=[
            'email'=>'required|email',
            'password'=>'required|string'
        ];
        $this->validate->Validator($rules);
        return $this->validate->has_error_validate();
    }
}