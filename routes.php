<?php defined('VIZITKI') or die('Access denied'); ?>

<?php

#    $url = $_SERVER['REQUEST_URI'];

/*echo 'url= '.*/

$url = str_replace('/vizitki', '', $_SERVER['REQUEST_URI']);

// echo '<br><hr>';


$routes = array(
    array('url' => '', 'view' => 'home'),
    array('url' => '/', 'view' => 'home'),
    array('url' => '/registration', 'view' => 'register'),
    array('url' => '/trebovanija_k_maketam', 'view' => 'trebovanija_k_maketam'),
    array('url' => '/guestbook', 'view' => 'guestbook'),
    array('url' => '/oplata_i_dostavka', 'view' => 'oplata_i_dostavka'),
    array('url' => '/contact', 'view' => 'contact'),

    array('url' => '/catalog/vizitki', 'view' => 'catalog_vizitki'),
    array('url' => '/catalog/fotocalendari', 'view' => 'catalog_fotocalendari'),
    array('url' => '/catalog/calendari', 'view' => 'catalog_calendari'),
    array('url' => '/catalog/flaery', 'view' => 'catalog_flaery'),
    array('url' => '/catalog/listovki', 'view' => 'catalog_listovki'),
    array('url' => '/catalog/buklety', 'view' => 'catalog_buklety'),
    array('url' => '/catalog/plakaty', 'view' => 'catalog_plakaty'),
    array('url' => '/catalog/plakaty', 'view' => 'catalog_plakaty'),

    array('url' => '/catalog/edit-template-vizitki/', 'view' => 'vizitka_edit_group_list'),
    array('url' => '#^/catalog/edit-template-vizitki/(?P<alias>[a-z0-9-]+)/?$#i', 'view' => 'vizitka_edit_template_list'),
    array('url' => '#^/catalog/edit-template-vizitki/([a-z0-9-]+)/(?P<id>\d+)#i', 'view' => 'vizitka_edit_template'),

    array('url' => '/editor', 'view' => 'editor'),
    array('url' => '/upload-image', 'view' => 'uploadImageToEditor'),

    array('url' => '/offer/order', 'view' => 'offerOrder'),
    array('url' => '/save/order', 'view' => 'saveOrder'),

    array('url' => '/basket', 'view' => 'basket'),
    array('url' => '#^/basket/delete/(?P<delete_item_id>\d+)#i', 'view' => 'delete_item_from_basket'),


    /********************
        ADMIN PANEL
     ********************/
    array('url' => '#/admin/?$#', 'view' => 'admin_orders'),
    array('url' => '#^/admin/order/(?P<order_id>[a-z0-9-]+)/?$#i', 'view' => 'admin_order'),


);



$error404 = true;
foreach($routes as $route){
    if(preg_match($route['url'], $url, $match) || $route['url'] == $url){
        if(empty($match)){
            $view = $route['view'];
        }else{
            extract($match);
            // $alias - vizitka template alias
            // $id - vizitka template id
            // $delete_item_id
            // $order_id

            $view = $route['view'];
        }
        $error404 = false;
        break;
    }
}


if($error404){
    include VIEW.'error404.php';
    exit();
}