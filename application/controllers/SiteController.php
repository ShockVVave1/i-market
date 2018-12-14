<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 05.12.2018
 * Time: 12:59
 */

/**
 * Class SiteController
 * Контролле для обработки запросов связанных с оторажением главной страницы
 */
class SiteController extends Controller {

    /**
     * @param $params
     * Функция обработки запросов и отображение ответа
     */
    public function actionIndex(array $params){

        //Переменные по умолчанию:
        //Статус активности категории
        $status = '1';
        //Метод сортировки
        $sort_order='ASC';
        //Главная страница считаеться 0 категорией
        $parent_cat = 0;

        $getcurrentUrl = $_SERVER['REQUEST_URI'];//'\?[a-z A-z 0-9]+'

        //Массив-конфугирации для параметра функции getCategory()
        $getCatParams = array('status'=>$status, 'sort_order' => $sort_order,'parent_cat'=>$parent_cat);
        //Получение подробной информации о категориях-детях
        $categories = CategoryModel::getCategory($getCatParams);

        //Подключение отображения категорий
        require_once (ROOT.'/application/views/index.php');

    }
}