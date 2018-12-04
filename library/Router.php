<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 04.12.2018
 * Time: 21:25
 */

/**
 * Class Router
 * Предназначен для машрутизации запросов
 */
class Router
{
   //переменная рутов
   private $routes;

   public function __construct(){

       $routes_path = ROOT.'/application/configs/routes.php';
        try{
            if(!file_exists($routes_path)){
                throw new Exception('Руты не найдены');
            }else{
                $this -> routes = require_once ($routes_path);
            };
        }catch (Exception $e){
            echo  $e->getMessage();
        }
   }

   public  function  run(){
        var_dump($this->routes);
   }
}