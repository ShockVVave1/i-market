<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 04.12.2018
 * Time: 21:31
 */


//Массив рутов
$routes = array(

    'user/register' => 'user/register',

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