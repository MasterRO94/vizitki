<?php defined('VIZITKI') or die('Access denied'); ?>

<?php

    $admin_index = false;
    if(!isset($url)){
        $admin_index = true;

        require_once './../routes.php';

        require_once './model/model.php';

        require_once './../functions/functions.php';

    }else{
        require_once '/admin/model/model.php';

        require_once 'functions/functions.php';
    }


    switch($view){
        case('admin_orders'):
            $orders = getOrders();
            $users = getUsersForOrders($orders);
        break;

        case('admin_order'):
            $order = getOrder($order_id);
            $user = getUserForOrder($order['user_id']);
            if(!$user){
                setSession('admin', array('error' => 'database_error' ));
            }else{
                unset($_SESSION['admin']['error']);
            }

        break;

    }


if(($admin_index)){
    // HEAD
    include VIEW.'head.php';

    // CONTENT
    include VIEW.$view.'.php';

    // FOOTER
    include VIEW.'footer.php';
}else{
    // HEAD
    include ADMIN.VIEW.'head.php';


    // CONTENT
    include ADMIN.VIEW.$view.'.php';

    // FOOTER
    include ADMIN.VIEW.'footer.php';
}