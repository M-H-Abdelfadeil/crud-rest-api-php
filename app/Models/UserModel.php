<?php
namespace App\Models;
use App\Models\DatabaseConfig;
class UserModel extends DatabaseConfig{
   
    public function profile($id_user){
        $sql_user="SELECT id,name , email FROM users WHERE id = '$id_user' ";
      
        $profile=$this->db->run($sql_user)->fetch();
        if(!$profile){
            return false;
        }else{
            $sql_posts="SELECT title , description , id FROM posts WHERE user_id = '$id_user' ";
            $posts=$this->db->run($sql_posts)->fetchAll();
            return [
                'user'=>$profile,
                'posts'=>$posts,
            ];
        }
       
    }


    public function edit($id){
        $sql="SELECT id,name , email FROM users WHERE id = '$id' ";
        return $this->db->run($sql)->fetch();

    }


    public function update($id,$name,$email){
        
        return $this->db->update('users',
                [
                    'name'=>$name,
                    'email'=>$email
                ],
                [
                    'id'=>$id
                ]
            );
         
    }
}