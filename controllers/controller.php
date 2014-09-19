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


    /*------------------------------------------
    // UPLOAD IMAGE TO TEMP FOLDER FOR EDITOR //
    -------------------------------------------*/
        function uploadImage(){
            $error = false;
            if(empty($_FILES)){
                return false;
            }
            $type = explode('/', $_FILES['file']['type']);
            if($type[0] != 'image'){
                $result = 'Not image!';
                $error = true;
            }
            if($_FILES['file']['size'] > 2000000){
                $result = 'Too large!';
                $error = true;
            }

            if(!$error){
                $uploadDir = 'uploads/_temp/';
                $uploadImage = $uploadDir . uniqid(true) .'.'. $type[1];
                $result = array('tmp_name' => $_FILES['file']['tmp_name'], 'uploadDir' => $uploadDir, 'uploadImage' => $uploadImage);
                $success = is_uploaded_file($_FILES['file']['tmp_name']);

               /* print_arr($_FILES);
                var_dump($result);
                die;*/

                if($success){
                    move_uploaded_file($_FILES['file']['tmp_name'], $uploadImage);

                    $result[] = '<script type="text/javascript">
                                 $("body").empty();
                                  var photo_name = "' .$uploadImage. '";
                                  window.parent.$("#new_photo").html(photo_name);
                                </script>';
                }else{
                    $result[] = 'File not uploaded!';
                }

            }
            return $result;
        }
    /*-------------------------------------------*/






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
               echo uploadImage();
               var_dump(uploadImage());
               print_arr($_FILES);
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

