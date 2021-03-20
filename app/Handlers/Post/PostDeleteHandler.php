<?php
namespace App\Handlers\Post;
use App\Handlers\Handler;
use Firebase\JWT\JWT;
class PostDeleteHandler extends Handler{
    public function delete($model){
        
        $nedded_requsts=['id_post','token'];
        $data_not_found=notfound_data($nedded_requsts);
        
        if($data_not_found){
            $msg="The data you have sent is incomplete. Add the data ( ".implode(' - ', $data_not_found) . ' )';
            return res_jsone(0,$msg);
        }

        $has_error=$this->validate_delete();
        if($has_error){
            return res_jsone(0,'error validate',$has_error);
        }

        try{
            $data_decode=JWT::decode($_POST['token'],SECRET_TOKEN,[HASH_TOKEN]);
            $id_user= $data_decode->data_user->id;
            return $this->execute_delete($model,$id_user,$_REQUEST['id_post']);
           
        }catch(\Exception $e){
            return res_jsone(0,$e->getMessage());
        }

    }



    private function validate_delete(){
        $rules=[
            'id_post'=>'required|number|min_val:1',
            'token'=>'required'
        ];
        $this->validate->Validator($rules);
        return $this->validate->has_error_validate();
         
    }

    private function execute_delete($model,$id_user,$id_post){
        $id_post=$this->filter->num_int($id_post);

        $delete=$model->delete($id_user,$id_post);

        if($delete){
            return res_jsone(1,'The post has been successfully deleted');
        }else{
            $msg="Deleting the post failed because it does not exist or you do not have permission to delete it";
            return res_jsone(0,$msg);
        }
    }
}