<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 07.12.2018
 * Time: 13:13
 */

/**
 * Переменная с дирректорией до дирректории стилей
 */
$pubCssDir = '/i-market/public/css';

/**
 * Возвращает массив поключенных стилей для header и footer
 */
return array(
    'header' => array(
        'bootstrap' => $pubCssDir.'/bootstrap/bootstrap.min.css',
        'mystyle' => $pubCssDir.'/mystyle.css'
    ),
    'footer' => array(

    )
);