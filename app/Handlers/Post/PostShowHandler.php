<?php
namespace App\Handlers\Post;
use App\Handlers\Handler;
class PostShowHandler extends Handler{
    public function show($model){

        $nedded_requsts=['id_post'];
        $data_not_found=not_found_data($nedded_requsts);
        
        if($data_not_found){
            $msg="The data you have sent is incomplete. Add the data ( ".implode(' - ', $data_not_found) . ' )';
            return res_json(0,$msg);
        }
        $has_error=$this->validate_show();
        if($has_error){
            return res_json(0,'error validate',$has_error);
        }

        return res_json(1,'success',$this->get_post($model));
        
    }

    private function validate_show(){
        $rules=[
            'id_post'=>'required|number'
        ];
        $this->validate->Validator($rules);
        return $this->validate->has_error_validate();
         
    }

    private function get_post($model){
        $id_post=$this->filter->num_int($_REQUEST['id_post']);
         $data= $model->show($id_post);
         if($data){
             return $data;
         }else{
            return [];
         }

    }
}