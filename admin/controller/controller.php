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


/**----------------------------------------------------
// DOWNLOAD USER TEMPLATE IMAGES FROM ORDER FOLDER   //
----------------------------------------------------**/
    function getOrderLayouts($id){

        $dir = './uploads/orders/'.$id.'/';

        if($files = scandir($dir)){
            unset($files[0]);
            unset($files[1]);
            $files = array_values($files);

            for($i=0; $i<count($files); $i++){
                $layouts[$i]['src'] = $dir.$files[$i];
                $layouts[$i]['type'] = end(explode(".", $files[$i]));
                $layouts[$i]['size'] = ceil(filesize($dir.$files[$i]) / 1024) < 1024 ? ceil(filesize($dir.$files[$i]) / 1024) . ' Кб' : (round(filesize($dir.$files[$i]) / 1024 / 1024, 2)) . ' Мб';
            }
        }else{
            return false;
        }

        return $layouts;
    }


    if(isset($_POST['order_id'])){
        $order_id = $_POST['order_id'];
        if(deleteOrder($order_id)){
            removeOrderLayouts($order_id);
            echo 'OK';
        }
        else{
            echo 'Error!';
        }
        exit();
    }


/**=================================================================================================
-------------------      DOWNLOAD CONTENT FOR VIEWS AND SWITCH FUNCTIONS      ----------------------
===================================================================================================**/
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

            if($order['layout']){
                $layouts = getOrderLayouts($order_id);
            }

            if(isset($_POST['edit_order'])){
                $order_id = $_POST['order_id'];
                $order_status= $_POST['order_status'];
                editOrder($order_id, $order_status);
                redirect();
            }

        break;

        case('admin_del_order'):
            $order_id = $_POST['id'];
            deleteOrder($order_id);
            removeOrderLayouts($order_id);
            redirectTo(ADMIN);
        break;


        case('admin_catalog'):
            switch($catalog_alias){
                case('group_list'):
                    $groups = getAdminServices();
                    $view = 'group_list';
                break;

                default:
                    include VIEW.'error404.php';
                exit();
            }
        break;

        case('admin_catalog_item'):
            switch($catalog_alias){
                case('group'):
                    //$group = getAdminService($item_id);
                    $view = 'group';
                    break;

                default:
                    include VIEW.'error404.php';
                    exit();
            }
        break;



    } // END SWITCH


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