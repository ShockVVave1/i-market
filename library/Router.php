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

   //Получение uri запроса
   public function getUri(){

       if(!empty($_SERVER['REQUEST_URI'])){
           return trim($_SERVER['REQUEST_URI'], '/');
       }
   }


   public  function  run(){
       $uri = $this ->getUri();

       /**
        * TODO Убрать код при размещении на хостинге
        */
       $uri = substr($uri,stripos($uri,'/')+1);

       //Цикл проверки запроса на совпадение с рутами
       foreach ($this->routes as $uriPattern => $path){

           if(preg_match('~^'.$uriPattern.'$~', $uri)){

               //количество подмасок в пути
               $mask_count = substr_count($path, '$');

               //количество параметров в запросе
               $param_count=substr_count($uri,'?');

               //если есть параметры добавляем в путь подмаску
               if($param_count > 0){
                   $path.='/$'.($mask_count+1);
               }

               //Получение внутреннего маршрута
               $internalPath = preg_replace('~^'.$uriPattern.'$~',$path,$uri);

               //Деление внутреннего маршрута на сегменты
               $segments = explode('/',$internalPath);

                //Получение имени контроллера
               $controllerName = array_shift($segments).'Controller';
               $controllerName = ucfirst($controllerName);

               //Получение имени метода
               $actionName = 'action'.ucfirst(array_shift($segments));

               //Получение параметров
               $params = $segments;

               //Подключение файлов контроллера
               $controllerFile = ROOT.'/application/controllers/'.$controllerName.'.php';

               try{
                   if(file_exists($controllerFile)){
                       include_once ($controllerFile);
                   }else{
                       throw new Exception('Контроллер не найден');
                   }
               }catch(Exception $e){
                    echo $e ->getMessage();
               }

               //Создание экземпляра контроллера
               $controllerObject = new $controllerName();

               //Вызов метода
               $result = $controllerObject->$actionName($params);

               if($result!=null){
                   break;
               }
           }
       }
   }
}