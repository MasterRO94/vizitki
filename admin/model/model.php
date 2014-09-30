<?php defined('VIZITKI') or die('Access denied'); ?>

<?php
/*================================================================*/
/*======================== connect to database ===================*/
/*================================================================*/

$link = mysqli_connect(HOST, USER, PASS) or die('No connect to Server');

mysqli_select_db($link,DB) or die('No connect to DB');
mysqli_query($link,"SET NAMES 'UTF8'") or die('Cant set charset');

/*======================= connect to database  ===========================*/

    function getOrders(){
        global $link;

        return true;
    }