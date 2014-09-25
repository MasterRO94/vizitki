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


/*============== Save Order ================*/
    function saveOrder($save){
        global $link;

        foreach($save as $item){
            if($item == '')
                $item = NULL;
        }

        $q = "INSERT INTO `orders` (`id`, `user_id`, `type`, `count`, `type_sides`, `wishes`, `paper_type`, `image_face`, `image_back`, `dop_uslgi`) VALUES(NULL, 1, '{$save['type']}', '{$save['kolvo']}', '{$save['type_sides']}', '{$save['wishes']}', NULL, '".$save['img_out']."', NULL, NULL)";
        echo "$q";
        $result = mysqli_query($link,$q);
        if(!$result){
            return false;
        }
        return true;
    }

/*============== Get PageContent ================*/





























