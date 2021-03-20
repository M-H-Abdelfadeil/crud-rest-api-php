<?php
function res_jsone($status,$msg,$data=false){
    $data= [
        'status'=>$status,
        'message'=>$msg,
        'data'=>$data
    ];
    echo json_encode($data);
}

function notfound_data($needed_requests){
    $diff=array_diff($needed_requests,array_keys($_POST));
    if (count($diff)==0)return false;
    else return $diff;
}