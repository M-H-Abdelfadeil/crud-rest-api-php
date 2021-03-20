<?php
namespace App\Controllers;
use App\Handlers\User\UserProfileHandler;
use App\Handlers\User\UserEditHandlers;
use App\Handlers\User\UserUpdateHandlers;
use App\Models\UserModel;
class UserController{

    public function profile(){
        $profile=new UserProfileHandler;
        return $profile->profile(new UserModel);
    }


    public function edit(){
        $edit=new UserEditHandlers;
        return $edit->edit(new UserModel);
    }

    public function update(){
        $update=new UserUpdateHandlers;
        return $update->update(new UserModel);
    }

}