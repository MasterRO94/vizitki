<?php

//Denied straight access
define('VIZITKI', TRUE);


// include file configurations
if(!isset($url)){
	require_once '../config.php';
}else{
	require_once './config.php';
}




// CONTROLLER
require_once 'controller/controller.php';
