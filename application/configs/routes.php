<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 04.12.2018
 * Time: 21:31
 */


//Массив рутов
$routes = array(
    '([a-z a-я]+)/([a-z a-я _]+)((?:[?][a-z]+[=][a-z A-Z 0-9]+)+)'=>'category/index/$1/$2',
    '([a-z a-я]+)/([a-z a-я _]+)'=>'category/index/$1/$2',
    '([a-z a-я]+)'=>'category/index/$1',
    //'([a-z]+)/([a-z]+)((?:[?][a-z]+[=][a-z A-Z 0-9]+)+)'=>'$1/$2',
    /**
     * TODO при переносе на норма хостинг поменять '-market' на '/'
     */
    '-market'=>'site/index'

);

return $routes;