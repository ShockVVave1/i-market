<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 09.12.2018
 * Time: 21:08
 */

/**
 * Class CategoryController
 * Контролле для обработки запросов связанных с оторажением страниц категорий
 */
class CategoryController extends Controller{

    /**
     * @param array $params {Тег категории [, Доп пармаетры]}
     * Функция обработки запросов и отображение ответа
     */
    public function actionIndex(array $params){

        //Переменные по умолчанию:
        //Статус активности категории
        $status = 1;
        //Метод сортировки
        $sort_order='ASC';

        //Получение более подробной информации по текущей категории
        $params=parent::checkPath($params);

        //Упрощение, присвоение переменным заначений обработанных функцией
        //Массив id категорий-предков
        $cats=$params['cats'];
        //Массив текущих категорий|продуктов
        $ids=$params['ids'];
        //Массив тегов текущих категорий|продуктов
        $tags=$params['tags'];
        //Массив GET параметров
        $get_params=$params['get_params'];

        //Массив-конфугирации для параметра функции getCategory()
        $getCatParams = array('status'=>$status, 'sort_order' => $sort_order,'parent_cat'=>$ids[count($ids)-1]);

        //Получение подробной информации о категориях-детях
        $categories = CategoryModel::getCategory($getCatParams);
        //Получение информации о категориях для Меню категорий
        $allCategories = CategoryModel::getCategoryMenu(array('status' => 1));

        //Подключение хлебных крошек
        $breadcrumbs = function ($params){
            require ROOT.'/application/views/components/breadcrumbs.php';
        };

        //Подключение sidebar
        $sidebar = function ($allCategories,$params){
            require ROOT.'/application/views/components/sidebar.php';
        };

        //Если есть продукты - получение информации о продуктах
        if(intval($ids[count($ids)-1])!==0){
            //Массив-конфугирации для параметра функции getProductList()
            $getProductParams = array('status'=>$status, 'parent_cat'=>$ids[count($ids)-1]);
            //Получение информации о продуктах
            $products = ProductModel::getProductList($getProductParams);

        }

        //Подключение отображения категорий
        require_once ROOT.'/application/views/category.php';

        return true;

    }



}