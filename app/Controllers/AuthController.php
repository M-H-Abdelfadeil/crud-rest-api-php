<?php
namespace App\Controllers;
use App\Controllers\Controller;
use App\Traits\RegisterTrait;
class AuthController extends Controller{
    use RegisterTrait;
    public function login(){
        var_dump($this->model->login());
    }

    public function register(){
       $nedded_requsts=['name','email','password'];
       $data_not_found=notfound_data($nedded_requsts);
       if($data_not_found){
           $msg="The data you have sent is incomplete. Add the data ( ".implode(' - ', $data_not_found) . ' )';
           return res_jsone(0,$msg,500);
       }else{
           return $this->handler_register();
       }
    }


    



}