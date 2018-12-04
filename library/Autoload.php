<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 04.12.2018
 * Time: 21:01
 */


/**
 * @param $class_name
 * Автозагрузчик классов
 */
function component_autoloader($class_name){

    //возможные дирректории классов
    $array_paths = array(
        'application/controllers/',
        'application/models/',
        'application/views/',
        'library'

    );

    try{
        foreach ($array_paths as $path){
            $path = ROOT.$path.$class_name.'.php';

            if(is_file($path)){
                require_once ($path);
            }
        }
    }catch (Exception $e){
        echo $e->getMessage();
    }
}

/**
 * Регистрируем автозагрузчик
 */
spl_autoload_register('component_autoload');