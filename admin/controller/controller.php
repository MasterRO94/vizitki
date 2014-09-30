<?php defined('VIZITKI') or die('Access denied'); ?>

<?php

    require_once '../model/model.php';

    $view = !empty($_GET['view']) ? $_GET['view'] : 'orders';

    switch($view){
        case('orders'):
            $orders = getOrders();
        break;
    }