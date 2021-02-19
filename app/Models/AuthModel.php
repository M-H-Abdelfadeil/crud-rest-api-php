<?php
namespace App\Models;
use App\Models\DatabaseConfig;
class AuthModel extends DatabaseConfig{
    public function login($email){
      $sql="SELECT * FROM users WHERE email = '$email' ";   
      return $this->db->run($sql)->fetch();
    }


    public function register($name,$email,$password){
        $data=
        [
            'name'=>$name,
            'email'=>$email,
            'password'=>$password
        ];
        return $this->db->insert('users',$data);

        
    }
}