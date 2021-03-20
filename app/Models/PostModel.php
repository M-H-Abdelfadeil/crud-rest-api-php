<?php
namespace App\Models;
use App\Models\DatabaseConfig;
class PostModel extends DatabaseConfig{

    public function create($title,$description,$user_id){
        $data=[
            'title'=>$title,
            'description'=>$description,
            'user_id'=>$user_id
        ];
        return $this->db->insert('posts',$data);
    }

    public function index(){

        $sql="
        SELECT
        users.name As created_by , users.id AS user_id ,
        posts.title , posts.description , posts.id AS post_id FROM users 
        LEFT JOIN posts ON users.id = posts.user_id 
        ";

        return $this->db->run($sql)->fetchAll();
        
        
    }

    public function show($id){

        $sql="
        SELECT
        users.name As created_by , users.id AS user_id ,
        posts.title , posts.description , posts.id AS post_id FROM users 
        LEFT JOIN posts ON users.id = posts.user_id 
        WHERE posts.id = '$id'
        ";

        return $this->db->run($sql)->fetch();
        
        
    }


    public function delete($id_user,$id_post){
        return $this->db->delete('posts',[
            'id'=>$id_post,
            'user_id'=>$id_user,
        ]);
    }

    public function edit($id_user,$id_post){
        $sql="
        SELECT * FROM posts 
        WHERE id='$id_post' AND user_id='$id_user'
        ";
        return $this->db->run($sql)->fetch();
    }

    public function update($id_user,$id_post,$title,$description){
        $sql="
        SELECT id FROM posts
         WHERE id='$id_post' AND user_id='$id_user'
        ";
        if($this->db->run($sql)->fetch()){
            $this->db->update('posts',
                [
                    'title'=>$title,
                    'description'=>$description
                ],
                [
                    'id'=>$id_post
                ]
            );
            return true;
        }else{
            return false;
        }
    }
}