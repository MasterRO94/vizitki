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
                $uploadImageName = uniqid(true) .'.'. $type[1];
                $uploadImage = $uploadDir . $uploadImageName;
                //$result = array('tmp_name' => $_FILES['file']['tmp_name'], 'uploadDir' => $uploadDir, 'uploadImage' => $uploadImage);
                $success = is_uploaded_file($_FILES['file']['tmp_name']);

                /*print_arr($_FILES);
                var_dump($result);
                var_dump($success);
                die;*/


                if($success){
                    move_uploaded_file($_FILES['file']['tmp_name'], $uploadImage);
                    $result = '<head><script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
                                <script>window.jQuery || document.write(\'<script src="<?=VIEW?>js/jquery-1.11.1.min.js">\x3C/script>\')</script>
                                <script type="text/javascript">
                                 $(document).ready(function(){
                                     $("body").empty();
                                      var photo_name = "' .$uploadImageName. '";
                                      window.parent.$("#new_photo").html(photo_name);
                                 });
                                </script></head>';
                    unset($_POST['uploadImage']);
                }else{
                    $result = 'File not uploaded!';
                }

            }
            return $result;
        }
        /*------------------------------------------ END UPLOAD TEMP IMAGE FUNCTION --------------------------------------------------------*/

/*=============== TEST FOR TEXT PAGE ====================== */
    if(preg_match_all('/[catalog]{7,}[_]/', $view, $match)){
        $catalogView = $view;
        $view = 'textPage';
    };
/*==========================================================*/



/*=================================================================================================
-------------------      DOWNLOAD CONTENT FOR VIEWS AND SWITCH FUNCTIONS      ---------------------
===================================================================================================*/
    switch($view){
        // homepage
        case('home'):
            $bigButtonsMenu = getMenu('big_buttons');
            $services = getServices();
            $page = getPageContent($view);
            if(!$page){
                $page = '';
            }
        break;

        // edit templates group list
        case('vizitka_edit_group_list'):
            $bigButtonsMenu = getMenu('big_buttons');
            $group_templates = getGroupTemplates();
            $page = getPageContent($view);
            if(!$page){
                $page = '';
            }
        break;

        // edit template list
        case('vizitka_edit_template_list'):
            $bigButtonsMenu = getMenu('big_buttons');
            $templates = getTemplates($alias);
            $page = getPageContent($view);
            if(!$page){
                $page = '';
            }
        break;

        // edit template
        case('vizitka_edit_template'):
            $editor = true;
            $bigButtonsMenu = getMenu('big_buttons');
            $template = getTemplate($id);
            $page = getPageContent($view);
            if(!$page){
                $page = '';
            }
        break;

        //catalog text page
        case('textPage'):
            $bigButtonsMenu = getMenu('big_buttons');
            $page = getPageContent($catalogView);
            if(!$page){
                $page = '';
            }
            $view = 'textPage';
        break;

        //registration
        case('register'):
            if(isset($_POST[''])){}
        break;

        //editor
        case('editor'):
            $editor = true;
            $page = getPageContent($view);
            if(!$page){
                $page = '';
            }
        break;

        // uploadImage
        case('uploadImageToEditor'):
            if(isset($_POST['uploadImage'])){
               echo uploadImage();
            }else{
                redirect();
            }
        break;

        default:
            $view = 'home';
    }
/*================================================================================================
-------------------      DOWNLOAD CONTENT FOR VIEWS AND SWITCH FUNCTIONS      --------------------
==================================================================================================*/


// подключени вида
require_once VIEW.'index.php';

