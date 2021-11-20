<?php
include "../vendor/autoload.php"; // подключили автозагрузку
include "../app/core.php"; //подключили файл core

//print_r($_SERVER['REQUEST_URI']); // смотрим, какой адрес запрашивается

// список допустимых  url адресов
$routes = [
    '/' => 'App\\Controllers\\SiteController@index', // если запрашивается '/' вызывается класс SiteControllers и его метод index
    '/catalog' => 'App\\Controllers\\CatalogController@index',
    '/product' => 'App\\Controllers\\CatalogController@showProduct',
    '/add_product_form' => 'App\\Controllers\\CatalogController@showForm',
    '/save_product' => 'App\\Controllers\\CatalogController@saveProduct'
];

$runAction = 'App\\Controllers\\SiteController@notFound';
$uri = explode('?', $_SERVER['REQUEST_URI']);
$uri = $uri[0];

// перебираем пути, сравниваем с запрашиваемым
foreach ($routes as $route => $action) {
    if($uri == $route) {
        $runAction = $action;
        break;
    }
}

$runAction = explode('@', $runAction);
//print_r($runAction);
$controller = new $runAction[0]; // создаем объект класса
$controller->{$runAction[1]}(); // обращаемся к методу созданного объекта класса