<?php defined('VIZITKI') or die('Access denied'); ?>
<?php
/*================================================================*/
/*======================== connect to database ===================*/
/*================================================================*/

$link = mysqli_connect(HOST, USER, PASS) or die('No connect to Server');

mysqli_select_db($link,DB) or die('No connect to DB');
mysqli_query($link,"SET NAMES 'UTF8'") or die('Cant set charset');

/*======================= connect to database  ===========================*/


/*============== Get Menu (position: {main} || {footer} || {big_buttons} ) ================*/
    function getMenu($position){
        global $link;

        $q = "SELECT * FROM ".$position."_menu";
        $result = mysqli_query($link,$q);
        if(!$result){
            return NULL;
        }
        $menu = array();
        while($row = mysqli_fetch_assoc($result)){
            $menu[] = $row;
        }
        return $menu;
    }
/*============== Get Main Menu ================*/


/*============== Get Services ================*/
    function getServices(){
        global $link;

        $q = "SELECT * FROM services";
        $result = mysqli_query($link,$q);
        if(!$result){
            return NULL;
        }

        $services = array();
        while($row = mysqli_fetch_assoc($result)){
            $services[] = $row;
        }
        return $services;

    }

/*============== Get Services ================*/


/*============== Get PageHeaders ================*/
/*function getPageHeaders($page){
    global $link;

    $q = "SELECT text FROM page WHERE name='{$page}'";
    $result = mysqli_query($link,$q);
    if(!$result){
        return NULL;
    }

    $page_text = array();
    while($row = mysqli_fetch_assoc($result)){
        $page_text[] = $row;
    }
    if(count($page_text) > 1) return false;

    return $page_text[0];
}*/

/*============== Get PageText ================*/


/*============== Get PageText ================*/
function getPage($page){
    global $link;

    $q = "SELECT * FROM page WHERE name='{$page}'";
    $result = mysqli_query($link,$q);
    if(!$result){
        return NULL;
    }

    $page_text = array();
    while($row = mysqli_fetch_assoc($result)){
        $page_text[] = $row;
    }
    if(count($page_text) > 1) return false;

    return $page_text[0];
}

/*============== Get PageText ================*/





























