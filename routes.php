<?php defined('VIZITKI') or die('Access denied'); ?>

<?php

#    $url = $_SERVER['REQUEST_URI'];

echo 'url= '.$url = str_replace('/vizitki', '', $_SERVER['REQUEST_URI']);
echo '<br><hr>';

$routes = array(
    array('url' => '', 'view' => 'home'),
    array('url' => '/', 'view' => 'home'),
    array('url' => '/registration', 'view' => 'register'),
    array('url' => '/trebovanija_k_maketam', 'view' => 'trebovanija_k_maketam'),
    array('url' => '/guestbook', 'view' => 'guestbook'),
    array('url' => '/oplata_i_dostavka', 'view' => 'oplata_i_dostavka'),
    array('url' => '/contact', 'view' => 'contact'),
    array('url' => '#^/catalog/edit-template-vizitki/template/(\d+)#', 'view' => 'vizitka_edit'),
    array('url' => '/editor', 'view' => 'editor'),
    array('url' => '/upload-image', 'view' => 'uploadImageToEditor'),
);

//preg_match('#^/catalog/edit-template-vizitki/template/(\d+)#', $url, $matches);

$error404 = true;
foreach($routes as $route){
    if(preg_match($route['url'], $url, $match) || $route['url'] == $url){
        $view = $route['view'];
        $error404 = false;
        break;
    }
}

if($error404){
    include VIEW.'error404.php';
    exit();
}