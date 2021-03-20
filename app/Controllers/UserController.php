<?php
namespace App\Controllers;
use App\Handlers\User\UserProfileHandler;
use App\Models\UserModel;
class UserController{
    public function profile(){
        $profile=new UserProfileHandler;
        return $profile->profile(new UserModel);
    }
}