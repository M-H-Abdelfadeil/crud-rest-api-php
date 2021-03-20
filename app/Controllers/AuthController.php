<?php
namespace App\Controllers;
use App\Models\AuthModel;
use App\Controllers\Controller;
use App\Traits\LoginTrait;
use App\Handlers\Auth\LoginHandler;
use App\Handlers\Auth\RegisterHandler;
class AuthController{
    public function login(){
        $obj=new LoginHandler;
        $obj->login(new AuthModel);
    }

    public function register(){
        $obj =  new RegisterHandler();
        return $obj->register(new AuthModel);
    }


    



}