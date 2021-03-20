<?php
namespace App\Handlers\Auth;
use App\Handlers\Handler;
use Firebase\JWT\JWT;
class LoginHandler extends Handler{
    public function login($model){
        // check requests

        $nedded_requests=['email','password'];
        $data_not_found=notfound_data($nedded_requests);
        if($data_not_found){
            $msg="The data you have sent is incomplete. Add the data ( ".implode(' - ', $data_not_found) . ' )';
            return res_jsone(0,$msg);
        }

        $has_error=$this->validate_login();
        if($has_error){
            return res_jsone(0,'error validate',$has_error);
        }else{
            $this->execute_login($model);
        }
    }


    public function execute_login($model){
        $email   =$this->filter->email($_REQUEST['email']);
        $password=$this->filter->string($_REQUEST['password']);
        $data=$model->login($email);
        if(!$data){
            return res_jsone(0 , 'The email and password do not match' );
        }else{
          $chk_pass= $this->check_password($password,$data['password']);
          if($chk_pass){
            $data_user=$this->set_token($data);  
            return res_jsone(1,'success login', $data_user);
          }else{
            return res_jsone(0 , 'The email and password do not match'  );
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
            'iss'=>HOST_APP,
            'iat'=>time(),
            'exp'=>time()+3600,
            'aud'=>'usersApi',
            'data_user'=>$data_user,

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