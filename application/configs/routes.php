<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 04.12.2018
 * Time: 21:31
 */


//Массив рутов
$routes = array(
    '([a-z]+)/([a-z]+)((?:[?][a-z]+[=][a-z A-Z 0-9]+)+)'=>'$1/$2',
    'buy'=>'buy/index',
    /**
     * TODO при переносе на норма хостинг поменять '-market' на '/'
     */
    '-market'=>'site/index'

);

return $routes;