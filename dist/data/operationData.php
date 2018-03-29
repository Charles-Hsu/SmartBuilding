<?php
$id=$_POST['id'];
// 獲取 id
// 把 id 傳去 sql刪除
$msg=[];
$msg['info']='success';
echo json_encode($msg);