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

// redirect To HomePage
function redirectToHomepage($message=NULL){
    header("Location: ".PATH);
    setSession('msg', $message);
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

