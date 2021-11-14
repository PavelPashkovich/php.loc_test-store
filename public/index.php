<?php
include "../vendor/autoload.php"; // подключили автозагрузку

//print_r($_SERVER['REQUEST_URI']); // смотрим, какой адрес запрашивается

// список допустимых  url адресов
$routes = [
    '/' => 'App\\Controllers\\SiteController@index', // если запрашивается '/' вызывается класс SiteControllers и его метод index
    '/catalog' => 'App\\Controllers\\CatalogController@index',
    '/catalog/11' => 'App\\Controllers\\CatalogController@showProduct'
];

$runAction = 'App\\Controllers\\SiteController@notFound';

// перебираем пути, сравниваем с запрашиваемым
foreach ($routes as $route => $action) {
    if($_SERVER['REQUEST_URI'] == $route) {
        $runAction = $action;
        break;
    }
}

$runAction = explode('@', $runAction);
//print_r($runAction);
$controller = new $runAction[0]; // создаем объект класса
$controller->{$runAction[1]}(); // обращаемся к методу созданного объекта класса