<?php
namespace App\Controllers;
use App\Controllers\Controller;
use App\Traits\RegisterTrait;
use App\Traits\LoginTrait;
class AuthController extends Controller{
    use LoginTrait;
    use RegisterTrait;
    public function login(){
        $nedded_requsts=['email','password'];
        $data_not_found=notfound_data($nedded_requsts);
        if($data_not_found){
            $msg="The data you have sent is incomplete. Add the data ( ".implode(' - ', $data_not_found) . ' )';
            return res_jsone(0,$msg,500);
        }else{
            return $this->handler_login();
        }
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