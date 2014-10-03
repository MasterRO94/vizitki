<?php defined('VIZITKI') or die('Access denied'); ?>

<?php

/*================================================================*/
/*======================== connect to database ===================*/
/*================================================================*/

$link = mysqli_connect(HOST, USER, PASS) or die('No connect to Server');

mysqli_select_db($link,DB) or die('No connect to DB');
mysqli_query($link,"SET NAMES 'UTF8'") or die('Cant set charset');

/*======================= connect to database  ===========================*/


/*======================= GET ORDERS ===========================*/
    function getOrders(){
        global $link;

        $q = "SELECT * FROM orders";
        $result = mysqli_query($link, $q);
        if(!$result) return false;

        $orders = array();
        while($row = mysqli_fetch_assoc($result)){
            $orders[] = $row;
        }

        return $orders;
    }
/*======================= GET ORDERS ===========================*/


/*======================= GET USERS FOR ORDERS ===========================*/
    function getUsersForOrders($orders){
        global $link;

        $users_id = array();

        foreach($orders as $order){
            $users_id[] = $order['user_id'];
        }

        $users_id = '('.implode(',', $users_id).')';

        $q = "SELECT id,fio FROM users WHERE id IN $users_id";
        $result = mysqli_query($link, $q);
        if(!$result) return false;

        $users = array();
        while($row = mysqli_fetch_assoc($result)){
            $users[] = $row;
        }

        $user_result = array();

        foreach($users as $user)
            $user_result[$user['id']] = $user['fio'];

        return $user_result;
    }


/*======================= GET USERS FOR ORDERS ===========================*/



/*======================= GET ORDER ===========================*/
function getOrder($id){
    global $link;

    $q = "SELECT * FROM orders WHERE id={$id}";
    $result = mysqli_query($link, $q);
    if(!$result) return false;

    $order = array();
    while($row = mysqli_fetch_assoc($result)){
        $order[] = $row;
    }
    if(count($order) != 1) return false;

    return $order[0];
}
/*======================= GET ORDER ===========================*/


/*======================= EDIT ORDER STATUS===========================*/
function editOrder($id, $status){
    global $link;

    $q = "UPDATE orders SET status='{$status}', updated_at=NOW() WHERE id={$id}";
    $result = mysqli_query($link, $q);
    if(!$result) return false;

    return true;
}
/*======================= EDIT ORDER STATUS ===========================*/


/*======================= GET USER FOR ORDER ===========================*/
function getUserForOrder($id){
    global $link;

    $q = "SELECT * FROM users WHERE id={$id}";
    $result = mysqli_query($link, $q);
    if(!$result) return false;

    $user = array();
    while($row = mysqli_fetch_assoc($result)){
        $user[] = $row;
    }
    if(count($user) != 1) return false;

    return $user[0];
}
/*======================= GET USER FOR ORDER ===========================*/

function getPaperType($id){
    global $link;

    $q = "SELECT id, title, price FROM paper_type WHERE id = '{$id}'";
    $result = mysqli_query($link,$q);
    if(!$result){
        return NULL;
    }

    $paper_type = array();
    while($row = mysqli_fetch_assoc($result)){
        $paper_type[] = $row;
    }

    if(count($paper_type) != 1 ) return false;

    return $paper_type[0];
}

/*============== Get Paper Type ================*/

/*============== Get Tiraj ================*/
function getTiraj($id){
    global $link;

    $q = "SELECT * FROM tiraj_vizitki WHERE id={$id}";
    $result = mysqli_query($link,$q);
    if(!$result){
        return NULL;
    }

    $tiraj = array();
    while($row = mysqli_fetch_assoc($result)){
        $tiraj[] = $row;
    }

    if(count($tiraj) != 1) return false;

    return $tiraj[0];
}

/*============== Get Tiraj ================*/







