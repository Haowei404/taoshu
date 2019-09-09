<?php
    include 'conn.php';
  
    $mes = isset($_REQUEST['mes']) ? $_REQUEST['mes'] : '';
    $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '1';
    $num = isset($_REQUEST['num']) ? $_REQUEST['num'] : '10';
    $order = isset($_REQUEST['order']) ? $_REQUEST['order'] : 'asc';
    $content = isset($_REQUEST['content']) ? $_REQUEST['content'] : '';
    $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';

    $index = ($page - 1) * $num; 
    switch ($mes){
        case "order":
            $sql = "select * from bookinf_new order by new_price $order";
            $res = $conn->query($sql);
            $sql1 = "select * from bookinf_new order by new_price $order limit $index,$num";
            $res1 = $conn->query($sql1);
            $arr = $res->fetch_all(MYSQLI_ASSOC);
            $arr1 = $res1->fetch_all(MYSQLI_ASSOC);
            $data = array(
                'total'=> $res->num_rows,
                'group'=> $arr1,
                'all' => $arr
            );
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        break;
        case "init":
            $sql = "select * from bookinf_new";
            $res = $conn->query($sql);
            $sql1 = "select * from bookinf_new limit $index,$num";
            $res1 = $conn->query($sql1);
            $arr = $res->fetch_all(MYSQLI_ASSOC);
            $arr1 = $res1->fetch_all(MYSQLI_ASSOC);
            $data = array(
                'total'=> $res->num_rows,
                'group'=> $arr1,
                'all' => $arr
            );
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        break;
        case "discount":
            $sql = "select * from bookinf_new order by discount $order";
            $res = $conn->query($sql);
            $sql1 = "select * from bookinf_new order by discount $order limit $index,$num";
            $res1 = $conn->query($sql1);
            $arr = $res->fetch_all(MYSQLI_ASSOC);
            $arr1 = $res1->fetch_all(MYSQLI_ASSOC);
            $data = array(
                'total' => $res->num_rows,
                'group' => $arr1,
                'all' => $arr
            );
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        break;
        case "seleid":
            $sql = "select * from bookinf_new where id = '$id'";
            $res = $conn->query($sql);
            $arr = $res->fetch_all(MYSQLI_ASSOC);
            echo json_encode($arr,JSON_UNESCAPED_UNICODE);
        break;
        case "index":
            $sql = "select * from bookinf_new";
            $res = $conn->query($sql);
            $arr = $res->fetch_all(MYSQLI_ASSOC);
            echo json_encode($arr,JSON_UNESCAPED_UNICODE);
        break;
    }
?>
