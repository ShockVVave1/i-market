<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 04.12.2018
 * Time: 15:13
 */

//FRONT CONTROLLER

//1. Общие настройки
if($_SERVER['APPLICATION_ENV'] == 'development'){

   error_reporting(E_ALL);
   ini_set("display_errors",1);

}

//3. Старт сессии
session_start();

//2. Подключение файлов системы
define('ROOT',dirname(__FILE__));
require_once (ROOT.'/library/Autoload.php');


//3. Установка соединения с БД


//4. Вызов Router

$router = new Router();
$router ->run();