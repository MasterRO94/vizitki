<?php defined('VIZITKI') or die('Access denied'); ?>

<?php

/********* IF IT's ADMIN PANEL SKIP FRONTEND **********/
// if admin panel
$admin = strpos($url, 'admin');
if ($admin !== false){
    require_once './admin/index.php';
    exit();
}


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

    /**---------------------------------------------------
    // DOWNLOAD USER TEMPLATE IMAGES FROM TEMP FOLDER   //
    ---------------------------------------------------**/
    function getLayouts(){
        if(!getSession('USER')) return NULL;

        $dir = 'uploads/_tmp/'.$_SESSION['USER']['user_id'].'/';

        if($files = scandir($dir)){
            unset($files[0]);
            unset($files[1]);
            $files = array_values($files);

            for($i=0; $i<count($files); $i++){
                $layouts[$i]['src'] = '/'.$dir.$files[$i];
                $layouts[$i]['type'] = end(explode(".", $files[$i]));
                $layouts[$i]['size'] = ceil(filesize($dir.$files[$i]) / 1024) < 1024 ? ceil(filesize($dir.$files[$i]) / 1024) . ' Кб' : (round(filesize($dir.$files[$i]) / 1024 / 1024, 2)) . ' Мб';
            }


        }else{
            return false;
        }

        return $layouts;
    }


    /**---------------------------------------------------------------------------------------------------------------------//
    // UPLOAD USER TEMPLATE IMAGE TO TEMP FOLDER   //
    ----------------------------------------------**/
    if(isset($_POST['uploader'])){
        if(!getSession('USER')){
           $user_id = createSessionUser();
        }

        uploadLayoutes();
    }

    function uploadLayoutes(){

        // Все загруженные файлы помещаются в папку $uploaddir
        $user_folder = getSession('USER');
        $user_folder = $user_folder['user_id'];

        mkdir('uploads/_tmp/'.$user_folder);

        $uploaddir = 'uploads/_tmp/'.$user_folder.'/';

        // Вытаскиваем необходимые данные
        $file = $_POST['data']['value'];
        $name = $_POST['data']['name'];

        // Получаем расширение файла
        $getMime = explode('.', $name);
        $mime = end($getMime);

        // Выделим данные
        $data = explode(',', $file);

        // Декодируем данные, закодированные алгоритмом MIME base64
        $encodedData = str_replace(' ','+',$data[1]);
        $decodedData = base64_decode($encodedData);

        // Вы можете использовать данное имя файла, или создать произвольное имя.
        // Мы будем создавать произвольное имя!
        $randomName = substr_replace(sha1(microtime(true)), '', 12).'.'.$mime;

        // Создаем изображение на сервере


        if($mime == 'psd'){
            echo 'PSD';
            exit();
        }else{
            if(file_put_contents($uploaddir.$randomName, $decodedData)) {
                $filesize = ceil(($uploaddir.$randomName) / 1024) < 1024 ? ceil(filesize($uploaddir.$randomName) / 1024) . ' Кб' : (round(filesize($uploaddir.$randomName) / 1024 / 1024, 2)) . ' Мб';
                echo $randomName.":загружен успешно:".$user_folder.':'.$mime.':'.$filesize;
            }
            else {
                // Показать сообщение об ошибке, если что-то пойдет не так.
                echo "Что-то пошло не так. Убедитесь, что файл не поврежден!";
            }
        }


        exit();

    }

    /************************ END UPLOADING USER TEMPLATES****************************/



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

    /*------------------------------------------
    //           CONVERT IMAGE TO PNG          //
    -------------------------------------------*/
    /*if($_POST['doImage']){
        $data = $_POST['dataImg'];
        $img = str_replace('data:image/png;base64,', '', $data);
        $img = str_replace(' ', '+', $img);
        $name = uniqid();
        $result = file_put_contents("/uploads/_tmp/$name.png", base64_decode($img));

            echo 'OK';
        exit;

    }*/
    /*------------------------------------------ END CONVERTING IMAGE FUNCTION --------------------------------------------------------*/





/*=============== TEST FOR TEXT PAGE ====================== */
    if(preg_match_all('/[catalog]{7,}[_]/', $view, $match)){
        $catalogView = $view;
        $view = 'textPage';
    };
/*==========================================================*/


/*=============== OFFER ORDER ====================== */
    function offerOrder(){
        if(isset($_POST['confirm_copy_rights'])){
            if(isset($_POST['wishes'])){

                $save = array();

                $save['wishes'] = $_POST['wishes'];

                $error = '';

                if(!isset($_POST['printing_type'])){
                    $error .= '<li>Не выбран тираж</li>';
                }else{
                    $save['printing_type'] = getPrintingType($_POST['printing_type']);
                    if(!$save['printing_type']) $error .= 'Ошибка!';
                }

                if(!isset($_POST['paper_type'])){
                    $error .= '<li>Не выбрано количество</li>';
                }else{
                    $save['paper_type'] = getPaperType((int)abs($_POST['paper_type']));
                }

                if(!isset($_POST['kolvo'])){
                    $error .= '<li>Не выбрано количество</li>';
                }else{
                    $save['tiraj'] = $save['printing_type']['id'];
                    $save['kolvo'] = $_POST['kolvo'] != 0 ? (int)abs($_POST['kolvo']) : 1;
                }

                if(isset($_POST['EXTRA'])){
                    $extra = getExtra();
                    foreach($extra as $ext){
                        if(isset($_POST['EXTRA'][$ext['name']]))
                            $save['dop_uslugi'] .= $_POST['EXTRA'][$ext['name']].',';
                    }
                }else{
                    $save['dop_uslugi'] = NULL;
                }

                if(isset($_POST['edit_template'])){
                    $save['type'] = 'Визитки';
                }else{
                    $save['type'] = $_POST['type'];
                }

                if(isset($_POST['TMPL'])){
                    $save['type_sides'] = (int)abs($_POST['TMPL']['type_side']);
                    $save['img_out_1'] = $_POST['TMPL']['img_out_1'];
                    if( $save['type_sides'] == 2)
                        $save['img_out_'] = $_POST['TMPL']['img_out_2'];
                }else{
                    $save['type_sides'] = NULL;
                    $save['img_out'] = NULL;
                }



                if($error == ''){
                    unset($_SESSION['error']);
                    unset($_SESSION['errors']);

                    $totalSum = ($save['printing_type']['price'] + $save['paper_type']['price']) * $save['kolvo'];

                    $_SESSION['basket'][] = array(
                        'type' => $save['type'],
                        'tiraj' => $save['tiraj'],
                        'kolvo' => $save['kolvo'],
                        'type_sides' => $save['type_sides'],
                        'wishes' => $save['wishes'],
                        'paper_type' => $save['paper_type'],
                        'image_face' => $save['img_out'],
                        'image_back' => $save['image_back'],
                        'dop_uslugi' => $save['dop_uslugi'],
                        'totalSum' => $totalSum,
                    );
                    redirectTo('/basket');

                    unset($_SESSION['errors']);

                }else{
                    setSession('errors', $error);
                    redirect();
                }
            }
        }else{
            setSession('errors', 'Ошибка!');
            redirect();
        }
    }
/*==========================================================*/


/*=============== OFFER ORDER ====================== */
    function checkAndSaveOrder(){
        if(!getSession('USER')){
            if(!isset($_POST['USER']))
                return false;
            setSession('USER', array(
                    'name' => $_POST['USER']['name'],
                    'phone' => $_POST['USER']['phone'],
                    'email' => $_POST['USER']['email'],
                    'address' => $_POST['USER']['address'],
                )
            );
        }

        $orders = getSession('basket');

        foreach($orders as $order){
            saveOrder($order);
            /*if(!saveOrder($order));
            return false;*/
        }

        return true;
    }
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
            $tiraj = getTiraj('vizitki');
            $template = getTemplate($id);
            $paper_types = getPaperTypes();
            $page = getPageContent($view);
            if(!$page){
                $page = '';
            }
        break;

        // upload template layout
        case('upload_layout'):
            $editor = true;
            $bigButtonsMenu = getMenu('big_buttons');
            $title = getServiceTitle($layout_alias);
            if(!$title || $title == NULL ) setSession('error', 'Database error');
                else unset($_SESSION['error']);
            $tiraj = getTiraj($layout_alias);
            if($layout_alias == 'vizitki') $extra = getExtra();
            $paper_types = getPaperTypes();

            $layouts = getLayouts();

            print_arr($_SESSION);

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

        //basket
        case('basket'):

        break;

        //offer order
        case('offerOrder'):
            offerOrder();
        break;

        //save order
        case('saveOrder'):
            if(!checkAndSaveOrder())
                redirect();
            unset($_SESSION['basket']);
            redirectTo('/basket', 'Ваш заказ успешно оформлен. С вами свяжутся в близжайшее время наши администраторы.');
        break;

        // delete item from basket
        case('delete_item_from_basket'):
            deleteItemFromBasket($delete_item_id);
        break;

        default:
            $view = 'home';
    }
/*================================================================================================
-------------------      DOWNLOAD CONTENT FOR VIEWS AND SWITCH FUNCTIONS      --------------------
==================================================================================================*/


// подключени вида
require_once VIEW.'index.php';

