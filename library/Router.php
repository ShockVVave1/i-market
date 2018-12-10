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

   /**
    * Получение uri запроса
    */
   public function getUri(){

       if(!empty($_SERVER['REQUEST_URI'])){
           return trim($_SERVER['REQUEST_URI'], '/');
       }
   }


   public  function  run(){
       $uri = $this ->getUri();

       $uri = urldecode($uri);

       var_dump($uri);
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

               $params=$this->checkPath($params);

               //Вызов метода
               $result = $controllerObject->$actionName($params);

               if($result!=null){
                   break;
               }
           }
       }
   }

   public function checkPath($params){

       $arr= array();

       var_dump($params);
       $i=1;
       foreach ($params as $param=>$value){

           switch ($i){
               case 1:{
                   $cat = CategoryModel::getCatByTag($value);
                       $arr['parent_cat'] = $cat['id'];
                       $arr['parent_tag']=$value;
                       break;

               }
               case 2:{
                   $cat = CategoryModel::getCatByTag($value);
                   if ($cat['parent_cat']==0){
                       die();
                   }else{
                       $arr['child_tag']=$cat['tag'];
                       $arr['parent_cat'] = $cat['id'];
                       break;
                   }
               }
               case 3:{

               }

           }

        $i++;

       }

       return $arr;
   }
}