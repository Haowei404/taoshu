<?php
    include 'conn.php';

    //用户变量
    $account = isset($_REQUEST['account']) ? $_REQUEST['account'] : '';
    $uid = isset($_REQUEST['uid']) ? $_REQUEST['uid'] : '';
    $username = isset($_REQUEST['username']) ? $_REQUEST['username'] : '';
    $password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';
    $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
    $mes = isset($_REQUEST['mes']) ? $_REQUEST['mes'] : '';
    $adminname = isset($_REQUEST['adminname']) ? $_REQUEST['adminname'] : '';
    

    //商品变量
    $goodid = isset($_REQUEST['goodid']) ? $_REQUEST['goodid'] : '';
    $goodname = isset($_REQUEST['goodname']) ? $_REQUEST['goodname'] : '';
    $new_price = isset($_REQUEST['new_price']) ? $_REQUEST['new_price'] : '';
    $old_price = isset($_REQUEST['old_price']) ? $_REQUEST['old_price'] : '';
    $discount = isset($_REQUEST['discount']) ? $_REQUEST['discount'] : '';
    $stock = isset($_REQUEST['stock']) ? $_REQUEST['stock'] : '';
    $picurl = isset($_REQUEST['picurl']) ? $_REQUEST['picurl'] : '';
    $press = isset($_REQUEST['press']) ? $_REQUEST['press'] : '';
    $time = isset($_REQUEST['time']) ? $_REQUEST['time'] : '';
    $intro = isset($_REQUEST['intro']) ? $_REQUEST['intro'] : '';
    $author = isset($_REQUEST['author']) ? $_REQUEST['author'] : '';

    //商品页数
    $now = isset($_REQUEST['now']) ? $_REQUEST['now'] : '1';
    $num = isset($_REQUEST['num']) ? $_REQUEST['num'] : '10';
    $index = ($now - 1) * $num; 
    switch($mes){
        case "add":
            $sql2 = "INSERT INTO userinf(username,password,email) value('$username','$password','$email') ";
            $res2 = $conn->query($sql2);
            if($res2){
                $isokins = 'yes';
            }else{
                $isokins = 'no';
            }
            echo $isokins;
            // echo 1;
        break;
        case "del":
            $sql1 = "DELETE FROM userinf where uid = '$uid'"; 
            $res1 = $conn->query($sql1);
            if($res1){
                $isokdel = 'yes';
            }else{
                $isokdel = 'no';
            };
            echo $isokdel;
        break;
        case "init":
            $sql1 = "select * from userinf limit $index,$num";
            $res1 = $conn->query($sql1);
            $arr1 = $res1->fetch_all(MYSQLI_ASSOC);
            $sql = "SELECT * FROM userinf";
            $res = $conn->query($sql);
            $arr = $res->fetch_all(MYSQLI_ASSOC);
            $data = array(
                'total' => $res->num_rows,
                'group' => $arr1
            );
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        break;
        case "update":
            $sql = "UPDATE  userinf set username = '$username',password = '$password',email = '$email' where uid = '$uid'";
            $res = $conn->query($sql);
            if($res){
                $isokupdate = 'yes';
            }else{
                $isokupdate = 'no';
            };
            echo $isokupdate;
        break;
        case "login":
            $sql = "select adminname from admin where account = '$account' and password = '$password'";
            $res = $conn->query($sql);
            $arr = $res->fetch_all(MYSQLI_ASSOC);
            if($res->num_rows){
                echo json_encode($arr,JSON_UNESCAPED_UNICODE);
            }else{
                echo 'no';
            };
        break;
        case "goodadd":
            $sql = "insert into bookinf_new (name,image,authors,press,time,summary,new_price,old_price,discount,stock) values('$goodname','$picurl','$author','$press','$time','$intro',$new_price,$old_price,$discount,$stock)";
            $res = $conn->query($sql);
            if($res){
                echo 'yes';
            }else{
                echo 'no';
            };
        break;
        case "goodinit":
            $sql = "select * from bookinf_new";
            $res = $conn->query($sql);
            $sql1 = "select * from bookinf_new limit $index,$num";
            $res1 = $conn->query($sql1);
            $arr1 = $res1->fetch_all(MYSQLI_ASSOC);
            $arr = $res->fetch_all(MYSQLI_ASSOC);
            $data = array(
                'group' => $arr1,
                'total' => $res->num_rows
            );
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        break;
        case "changepwd":
            $sql = "update admin set password = '$password' where adminname = '$adminname'";
            $res = $conn->query($sql);
            if($res){
                echo 'success';
            }else{
                echo 'no';
            };
        break;
        case "gooddel":
            $sql = "delete from bookinf_new where id = $goodid";
            $res = $conn->query($sql);
            if($res){
                echo 'yes';
            }else{
                echo 'no';
            };
        break;
        case "goodupdate":
            $sql = "update bookinf_new set name = '$goodname', image = '$picurl', authors = '$author',press = '$press',time = '$time',summary = '$intro', new_price=$new_price, old_price=$old_price, discount=$discount, stock=$stock where id = $goodid";
            $res = $conn->query($sql);
            if($res){
                echo 'yes';
            }else{
                echo 'no';
            };
        break;
        case "orderinit":
            $sql = "select * from shopcar";
            $sql1 = "select * from shopcar limit $index,$num";
            $res = $conn->query($sql);
            $res1 = $conn->query($sql1);
            $arr1 = $res1->fetch_all(MYSQLI_ASSOC);
            $data = array(
                'group' => $arr1,
                'total' => $res->num_rows,
            );
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        break;
    }
?>