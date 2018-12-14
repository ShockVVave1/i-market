<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 10.12.2018
 * Time: 18:35
 */

/**
 * Class ProductController
 * Контролле для обработки запросов связанных с оторажением страниц продукт
 */
class ProductController extends Controller
{
    /**
     * @param array $params {Тег категории [, Доп пармаетры]}
     * Функция обработки запросов и отображение ответа
     */
    public function actionIndex(array $params){

        //Получение более подробной информации по текущей категории
        $params=parent::checkPath($params);
        //Массив тегов текущих категорий|продуктов
        $tags=$params['tags'];

        $allCategories = CategoryModel::getCategoryMenu();

        //Подключение хлебных крошек
        $breadcrumbs = function ($params){
            require ROOT.'/application/views/components/breadcrumbs.php';
        };

        //Подключение sidebar
        $sidebar = function ($allCategories,$params){
            require ROOT.'/application/views/components/sidebar.php';
        };

        //Получение информации о продуктах
        $product = ProductModel::getProductByTag($tags[count($tags)-1]);

        //Если такой продукт есть подключить отображение
        if($product){
            require ROOT.'/application/views/product.php';
        //Иначе перенаправить на 404
        }else{
            die();
        }


    }


}