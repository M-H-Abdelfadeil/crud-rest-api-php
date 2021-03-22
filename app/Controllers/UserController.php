<?php
namespace App\Controllers;
use App\Handlers\User\UserProfileHandlers;
use App\Handlers\User\UserEditHandlers;
use App\Handlers\User\UserUpdateHandlers;
use App\Handlers\User\UserUpdatePasswordHandlers;
use App\Handlers\User\UserDeleteHandlers;
use App\Models\UserModel;
class UserController{

    public function profile(){
        $profile=new UserProfileHandlers;
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

    public function updatePassword(){
        $updatePassword=new UserUpdatePasswordHandlers;
        return $updatePassword->updatePassword(new UserModel);
    }


    public function delete(){
        $delete=new UserDeleteHandlers;
        return $delete->delete(new UserModel);
    }

}