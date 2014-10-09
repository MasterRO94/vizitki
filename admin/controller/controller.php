<?php defined('VIZITKI') or die('Access denied'); ?>

<?php

	session_start();

    $admin_index = false;
    if(!isset($url)){
        $admin_index = true;

        require_once './../routes.php';

        require_once './model/model.php';

        require_once './../functions/functions.php';

    }else{
        require_once './admin/model/model.php';
		
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

            $tiraj = getTiraj($order['tiraj']);

            if(!$tiraj){
                setSession('admin', array('error' => 'database_error' ));
            }



            if(!empty($order['paper_type'])){
                $paper = getPaperType($order['paper_type']);
            }

            if(isset($_POST['edit_order'])){
                $order_id = $_POST['order_id'];
                $order_status= $_POST['order_status'];
                editOrder($order_id, $order_status);
                redirect();
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
    require '.'.ADMIN.VIEW.'head.php';

    // CONTENT
    include '.'.ADMIN.VIEW.$view.'.php';

    // FOOTER
    include '.'.ADMIN.VIEW.'footer.php';
}