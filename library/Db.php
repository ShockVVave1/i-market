<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 05.12.2018
 * Time: 22:42
 */

/**
 * Class Db
 * Класс работающий с БД
 */
class Db{


    /**
     * Возвращает коннекшн с БД
     */
    public static function getConnection(){

        $paramsPath = ROOT.'/application/configs/db_params.php';
        try{
            if(file_exists($paramsPath)){
                $params = require_once ($paramsPath);
            }else{
                throw new Exception("Настройки db не найдены");
            }
        }catch (Exception $e){
            echo $e->getMessage();
            die();
        }

        try{
            $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
            $db = new PDO($dsn, $params['user'],$params['password']);

            if($_SERVER['APPLICATION_ENV'] == 'development'){
                $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            }

            $db->exec('set names utf8');
        }catch (PDOException $e){
             echo $e->getMessage();
        }

        return $db;
    }


}