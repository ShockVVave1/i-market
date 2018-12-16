<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 07.12.2018
 * Time: 13:13
 */

/**
 * Переменная с дирректорией до дирректории скриптов
 */
$pubJsDir = '/i-market/public/js';

/**
 * Возвращает массив поключенных скриптов для header и footer
 */
return array(
    $header = array(


    ),
    $footer = array(
        'myjs' => $pubJsDir.'/myjs.js'
    )
);