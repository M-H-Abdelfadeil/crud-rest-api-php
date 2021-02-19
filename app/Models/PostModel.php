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
}