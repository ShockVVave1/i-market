<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 05.12.2018
 * Time: 22:35
 */

/**
 * Class Controller
 * Класс предок для контроллеров
 * Содержит общие функции контроллеров
 */
abstract class Controller
{

    /**
     * @param $params - {Тег категории|товара [, GET параметры]}
     * @return array -{Массив id категорий-предков, массив названий категорий|товаров, массив id текущей категории|товара [, массив со строка Get параметров]}
     * Получение дополнительной информации текущей категории|товара
     */
    public function checkPath($params){

        //Результирующий массив
        $arr=array('cats' => array(),'names' => array(),'tags' => array(),'ids'=>array(),'get_params'=>array());

        //Разворачивает массив $params для удобства обработки
        $params = array_reverse($params);

        //Вынимает первый элемент массива
        $var = array_shift($params);

        //Вынимает GET параметры записывает в $arr['get_params']
        if(!(strrpos($var,'?')===false)){
            $arr['get_params'][] = $var;
            $var = array_shift($params);
        }

        //Цикл который работает пока перебираемый элемент не будет иметь категорию предка ($parent_cat) = 0
        $parent_cat=1;
        while(intval($parent_cat)!==0){
            //Генератор который необходима для определения типа элемента и информацию об элементе
            foreach ($gen =(function ($tag){
                yield ProductModel::getProductByTag($tag);
                yield CategoryModel::getCatByTag($tag);
                yield CategoryModel::getCatByTag($tag);
            })($var) as $obj){


                //Если такоей объект существует записывает данные
                if (is_array($obj)){
                    //Меняеться переменная участвующая в условии цикла
                    $parent_cat=$obj['parent_cat'];

                    $arr['cats'][]=$obj['parent_cat'];
                    $arr['names'][] = $obj['name'];
                    $arr['tags'][] = $obj['tag'];
                    $arr['ids'][] = $obj['id'];

                    //Получение следующего элемента
                    $var = array_shift($params);
                    break;
                }
            }
        }
        //Возврат результирующему массиву первоначально порядка
        $arr['cats']=array_reverse($arr['cats']);
        $arr['names']=array_reverse($arr['names']);
        $arr['tags']=array_reverse($arr['tags']);
        $arr['ids']=array_reverse($arr['ids']);

        return $arr;
    }

    public static function checkAdmin(){

        $userId = UserModel::checkLogged();

        $user = UserModel::getUserById($userId);

        if($user['role'] = 'admin'){
            return true;
        }

        die('Access denied');
    }

}