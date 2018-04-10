<?php
$id=$_POST['id'];
$meeting_type=$_POST['meeting_type'];

if( $meeting_type == 1 || $meeting_type == 2 ){
    $sql="";

    if(true){
        $msg[0]='success';
        $any_data='自訂義';
    }else{
        $msg[0]='error';
    }

    $msg[1]=$any_data;
}else{
    $sql="";

    if(true){
        $msg[0]='success';
        $any_data='自訂義';
    }else{
        $msg[0]='error';
    }

    $msg[1]=$any_data;
}

echo json_encode($msg);