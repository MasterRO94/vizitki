<?php defined('VIZITKI') or die('Access denied'); ?>

<?php

// print array
function print_arr($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

// redirect
function redirect(){
    $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
    header("Location: $redirect");
    exit;
}

// redirect To
function redirectTo($url, $message=null){

    setSession('success', $message);
    header("Location: ".PATH.$url);
    exit;
}


function setSession($name, $value){
    $_SESSION[$name] = $value;
    return true;
}

function getSession($name){
    if(!isset($_SESSION[$name])){
        return false;
    }
    return $_SESSION[$name];
}

function deleteItemFromBasket($id){
    unset($_SESSION['basket'][$id]);
    redirect();
}

function createSessionUser(){
    $d = date('d');
    $m = date('m');
    $y = date('Y');
    $h = date('H');
    $i = date('i');
    $s = date('s');

    $id = (int)$d . (int)$m . (int)$y . (int)$h . (int)$i . (int)$s;

    $_SESSION['USER']['user_id'] = $id;

    return $id;
}