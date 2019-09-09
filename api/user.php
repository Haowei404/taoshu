<?php

    include 'conn.php';
    
    $uid = isset($_REQUEST['uid']) ? $_REQUEST['uid'] : '';
    $username = isset($_REQUEST['username']) ? $_REQUEST['username'] : '';
    $password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';
    $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
    $mes = isset($_REQUEST['mes']) ? $_REQUEST['mes'] : '';
   
    switch($mes){
        case "add":
            $sql2 = "INSERT INTO userinf(username,password,email) value('$username','$password','$email') ";
            $res2 = $conn->query($sql2);
            if($res2){
                $isokins = 'yes';
                $sql = "SELECT uid FROM userinf where username = '$username'";
                $res = $conn->query($sql);
                $arr = $res->fetch_all(MYSQLI_ASSOC);
                echo json_encode($arr,JSON_UNESCAPED_UNICODE);
            }else{
                echo 'no';
            }
            
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
            $sql = "SELECT * FROM userinf";
            $res = $conn->query($sql);
            $arr = $res->fetch_all(MYSQLI_ASSOC);
            $data = array(
                'total' => $res->num_rows,
                'group' => $arr
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
            $sql = "SELECT * FROM userinf where username = '$username' and password='$password'";
            $res = $conn->query($sql);
            $arr = $res->fetch_all(MYSQLI_ASSOC);
            if($arr){
                $isoklogin = 'yes';
            }else{
                $isoklogin = 'no';
            };
            $data = array(
                'group' =>$arr,
                'isoklogin' =>$isoklogin
            );
            
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        break; 
        case 'checkusername':
            $sql = "SELECT * from userinf where username = '$username'";
            $res = $conn->query($sql);
            if($res->num_rows){
                echo 'yes';
            }else{
                echo 'no';
            };
        break;
        case 'checkemail':
            $sql = "select * from userinf where email = '$email'";
            $res = $conn->query($sql);
            if($res->num_rows){
                echo 'yes';
            }else{
                echo 'no';
            };
        break;                                                                                   
    }
  

?>