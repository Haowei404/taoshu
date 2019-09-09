<?php
    include 'conn.php';

    $uid = isset($_REQUEST['uid']) ? $_REQUEST['uid'] : '';
    $goods_id = isset($_REQUEST['goods_id']) ? $_REQUEST['goods_id'] : '';
    $con = isset($_REQUEST['con']) ? $_REQUEST['con'] : '';
    $mes = isset($_REQUEST['mes']) ? $_REQUEST['mes'] : '';
    $username = isset($_REQUEST['username']) ? $_REQUEST['username'] : '';

    switch ($mes){
        case 'insert' :
            $sql = "INSERT INTO comment(uid,goods_id,con,username) values($uid,$goods_id,'$con','$username')";
            $res = $conn->query($sql);
            if($res){
                echo 'yes';
            }else{
                echo 'no';
            };
        break;
        case 'init' :
            $sql = "SELECT * FROM comment where goods_id = $goods_id";
            $res = $conn->query($sql);
            $arr = $res->fetch_all(MYSQLI_ASSOC);
            echo json_encode($arr,JSON_UNESCAPED_UNICODE);
        break;
    }
    

    
?>