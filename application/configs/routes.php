<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 04.12.2018
 * Time: 21:31
 */


//Массив рутов
$routes = array(
    'admin/order/delete/([0-9]+)' => 'adminOrder/delete/$1',
    'admin/order/view/([0-9]+)' => 'adminOrder/view/$1',
    'admin/order' => 'adminOrder/index',

    'admin/product/update/([0-9]+)' => 'adminProduct/update/$1',
    'admin/product/create' => 'adminProduct/create',
    'admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1',
    'admin/product' => 'adminProduct/index',

    'admin/category/update/([0-9]+)' => 'adminCategory/update/$1',
    'admin/category/create' => 'adminCategory/create',
    'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1',
    'admin/category' => 'adminCategory/index',

    'admin' => 'admin/index',

    'user/login' => 'user/login',
    'user/register' => 'user/register',
    'user/logout' => 'user/logout',
    'user/edit' => 'user/edit',

    'cabinet' => 'cabinet/index',
    'cart/add/([0-9]+)' => 'cart/add/$1',
    'cart/kill/([0-9]+)' => 'cart/kill/$1',
    'cart/remove/([0-9]+)' => 'cart/remove/$1',
    'cart/clear' => 'cart/clear',
    'cart/addAjax' => 'cart/addAjax',
    'cart/checkout' => 'cart/checkout',
    'cart' => 'cart/index',


    '([a-z a-я A-Z a-z _]+)/([a-z a-я A-Z a-z _]+)/([a-z a-я A-Z a-z _]+)((?:[?][a-z]+[=][a-z A-Z 0-9]+)+)'=>'product/index/$1/$2/$3',
    '([a-z a-я A-Z a-z _]+)/([a-z a-я A-Z a-z _]+)/([a-z a-я A-Z a-z _]+)'=>'product/index/$1/$2/$3',
    '([a-z a-я A-Z a-z _]+)/([a-z a-я A-Z a-z _]+)((?:[?][a-z]+[=][a-z A-Z 0-9]+)+)'=>'category/index/$1/$2',
    '([a-z a-я A-Z a-z _]+)/([a-z a-я A-Z a-z _]+)'=>'category/index/$1/$2',
    '([a-z a-я A-Z a-z _]+)'=>'category/index/$1',
    //'([a-z]+)/([a-z]+)((?:[?][a-z]+[=][a-z A-Z 0-9]+)+)'=>'$1/$2',
    /**
     * TODO при переносе на норма хостинг поменять '-market' на '/'
     */
    '-market'=>'site/index'


);

return $routes;