<?php defined('VIZITKI') or die('Access denied'); ?>

<?php

    session_start();

    // INCLUDING MODEL
    require_once MODEL;

    // INCLUDING FUNCTIONS LIBRARY
    require_once 'functions/functions.php';

    // GET MAIN MENU AND FOOTER MENU LINKS
        $mainMenu = getMenu('main');
        $footerMenu = getMenu('footer');

    // EDITOR FLAG - IF TRUE LOAD CSS AND JS RESOURCES
    $editor = false;








/* ================================================================================================
-------------------      DOWNLOAD CONTENT FOR VIEWS AND SWITCH FUNCTIONS      --------------------
==================================================================================================*/
    switch($view){
        // homepage
        case('home'):
            $bigButtonsMenu = getMenu('big_buttons');
            $services = getServices();
            //$headers = getPageHeaders($view);
            if(!$headers){
                $headers = '';
            }
            $text = getPage($view);
            if(!$text){
                $text = '';
            }
        break;

        //registration
        case('register'):
            if(isset($_POST[''])){}
        break;

        //editor
        case('editor'):
            $editor = true;
        break;

        // uploadImage
        case('uploadImageToEditor'):
            if(isset($_POST['uploadImage'])){
               uploadImage();
            }else{
                redirect();
            }
        break;

        default:
            $view = 'home';
    }
/* ================================================================================================
-------------------      DOWNLOAD CONTENT FOR VIEWS AND SWITCH FUNCTIONS      --------------------
==================================================================================================*/


// подключени вида
require_once VIEW.'index.php';

