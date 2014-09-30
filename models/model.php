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

        $q = "SELECT * FROM services ORDER BY position";
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


/*============== Get Group Templates ================*/
    function getGroupTemplates(){
        global $link;

        $q = "SELECT * FROM templates_group";
        $result = mysqli_query($link,$q);
        if(!$result){
            return NULL;
        }

        $group_templates = array();
        while($row = mysqli_fetch_assoc($result)){
            $group_templates[] = $row;
        }
        return $group_templates;

    }

/*============== Get Group Templates ================*/


/*============== Get Group Templates ================*/
    function getTemplates($alias){
        global $link;

        $q = "SELECT * FROM template WHERE group_alias = '{$alias}'";
        $result = mysqli_query($link,$q);
        if(!$result){
            return NULL;
        }

        $templates = array();
        while($row = mysqli_fetch_assoc($result)){
            $templates[] = $row;
        }
        return $templates;

    }

/*============== Get Group Templates ================*/


/*============== Get Template ================*/
function getTemplate($id){
    global $link;

    $q = "SELECT * FROM template WHERE id = '{$id}'";
    $result = mysqli_query($link,$q);
    if(!$result){
        return NULL;
    }

    $template = array();
    while($row = mysqli_fetch_assoc($result)){
        $template[] = $row;
    }

    if(count($template) != 1 ) return false;

    return $template[0];
}

/*============== Get Template ================*/


/*============== Get Tiraj ================*/
function getTiraj(){
    global $link;

    $q = "SELECT * FROM tiraj_vizitki";
    $result = mysqli_query($link,$q);
    if(!$result){
        return NULL;
    }

    $tiraj = array();
    while($row = mysqli_fetch_assoc($result)){
        $tiraj[] = $row;
    }

    return $tiraj;
}

/*============== Get Tiraj ================*/


/*============== Get Tiraj ================*/
function getPrintingType($id){
    global $link;

    $q = "SELECT * FROM tiraj_vizitki WHERE id='{$id}'";
    $result = mysqli_query($link,$q);
    if(!$result){
        return NULL;
    }

    $pt = array();
    while($row = mysqli_fetch_assoc($result)){
        $pt[] = $row;
    }

    if(count($pt) != 1) return false;

    return $pt[0];
}

/*============== Get Tiraj ================*/



/*============== Get Paper Types ================*/
function getPaperTypes(){
    global $link;

    $q = "SELECT * FROM paper_type";
    $result = mysqli_query($link,$q);
    if(!$result){
        return NULL;
    }

    $paper_type = array();
    while($row = mysqli_fetch_assoc($result)){
        $paper_type[] = $row;
    }

    return $paper_type;
}

/*============== Get Paper Types ================*/


/*============== Get Paper Type ================*/
function getPaperType($id){
    global $link;

    $q = "SELECT id, title, price FROM paper_type WHERE id = '{$id}'";
    $result = mysqli_query($link,$q);
    if(!$result){
        return NULL;
    }

    $paper_type = array();
    while($row = mysqli_fetch_assoc($result)){
        $paper_type[] = $row;
    }

    if(count($paper_type) != 1 ) return false;

    return $paper_type[0];
}

/*============== Get Paper Type ================*/


/*============== Get Extra - Dop Uslugi ================*/
    function getExtra(){
        global $link;

        $q = "SELECT * FROM dop_uslugi";
        $result = mysqli_query($link,$q);
        if(!$result){
            return NULL;
        }

        $extra = array();
        while($row = mysqli_fetch_assoc($result)){
            $extra[] = $row;
        }

        return $extra;
    }

/*============== Get Tiraj ================*/



/*============== Get PageContent ================*/
function getPageContent($page){
    global $link;

    $q = "SELECT * FROM page WHERE name='{$page}'";
    $result = mysqli_query($link,$q);
    if(!$result){
        return NULL;
    }

    $pageContent = array();
    while($row = mysqli_fetch_assoc($result)){
        $pageContent[] = $row;
    }
    if(count($pageContent) > 1) return false;

    return $pageContent[0];
}

/*============== Get PageContent ================*/


/*=================== Save Order =====================*/
    function saveOrder($order){
        global $link;

        $user = getSession('USER');

        if(!isset($user['user_id'])){
            $q = "INSERT INTO `users` (`id`, `fio`, `phone`, `email`, `address`) VALUES (null, '{$user['name']}', '{$user['phone']}', '{$user['email']}', '{$user['address']}');";
            $result = mysqli_query($link,$q);
            $user['user_id'] = mysqli_insert_id($link);
            $_SESSION['USER']['user_id'] = $user['user_id'];
            if(!$result){
                return false;
            }
        }

        /*print_arr($user);
        echo '<br/>';
        print_arr($_SESSION['basket']);
        die;*/

        $q = "INSERT INTO `orders` (`id`, `user_id`, `type`, `count`, `type_sides`, `wishes`, `paper_type`, `image_face`, `image_back`, `dop_uslugi`) VALUES(NULL, '{$user['user_id']}', '{$order['type']}', '{$order['kolvo']}', '{$order['type_sides']}', '{$order['wishes']}', '{$order['paper_type']['id']}', '".$order['image_face']."', '".$order['image_back']."', '{$order['dop_uslugi']}')";
        $result = mysqli_query($link,$q);
        if(!$result){
            return false;
        }
        return true;
    }

/*=================== Save Order =====================*/





























