<?php
    include 'conn.php';

    $num = isset($_REQUEST['num']) ? $_REQUEST['num'] : '1';
    $uid = isset($_REQUEST['uid']) ? $_REQUEST['uid'] : '';
    $goods_id = isset($_REQUEST['goods_id']) ? $_REQUEST['goods_id'] : '';
    $create_time = isset($_REQUEST['create_time']) ? $_REQUEST['create_time'] : '';
    $mes = isset($_REQUEST['mes']) ? $_REQUEST['mes'] : '';

    switch ($mes){
        case 'insert' :
            $sql1 = "select * from shopcar where uid = $uid and goods_id = $goods_id ";
            $res1 = $conn->query($sql1);
            $arr1 = $res1->fetch_all(MYSQLI_ASSOC);
            if($arr1){
                $isokinsert = 'exist';
            }else{
                $sql = "INSERT INTO shopcar(uid,goods_id,number) values($uid,$goods_id,$num)";
                $res = $conn->query($sql);     
                if($res){
                    $isokinsert = 'yes';
                }else{
                     $isokinsert = 'no';
                };
            }
            
            echo $isokinsert;
        break;
        case 'selid':
            $sql = "select * from shopcar where uid = $uid";
            $res = $conn->query($sql);
            $arr = $res->fetch_all(MYSQLI_ASSOC);
            echo json_encode($arr,JSON_UNESCAPED_UNICODE);
        break;
        case 'del':
            $sql = "delete from shopcar where goods_id = $goods_id and uid = $uid";
            $res = $conn->query($sql);
            echo $res;
        break;
        case 'init':
            $sql= "SELECT * FROM shopcar where uid = $uid";
            $res = $conn->query($sql);
            $arr = $res->fetch_all(MYSQLI_ASSOC);
            echo json_encode($arr,JSON_UNESCAPED_UNICODE);
        break;
        case 'update':
            $sql = "UPDATE shopcar set number = $num where goods_id = $goods_id and uid = $uid";
            $res = $conn->query($sql);
            if($res){
                echo 'yes';
            }else{
                echo 'no';
            };
        break;

    }
    
    
?>