<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 09.12.2018
 * Time: 16:18
 */

/**
 * Class CategoryModel
 * Модель для работы с информацией о категориях из БД
 */
class CategoryModel extends Model {

    /**
     * @param array $params
     * @return array
     * Получение информации о категориях по параметрам
     */
    public static function getCategory(array $params = array()){

        //Получение соединения с БД
        $db = DB::getConnection();

        //Результирующий массив
        $categoryList = array();

        //Переменные по умолчанию:
        //Статус активности категории
        $status = '1';
        //Метод сортировки
        $sort_order='ASC';
        //Категория предок
        $parent_cat = null;

        //Извлечение переменных
        extract($params);

        //Если id категории предка = null убрать часть sql запроса
        if (is_null($parent_cat)){
            $parent_cat_part=" ";
        }else{
            $parent_cat_part = " AND parent_cat = $parent_cat ";
        }

        //Запрос sql в БД
        $result = $db->query("SELECT * FROM imarket_db.im_category WHERE status = $status $parent_cat_part"
                ." ORDER BY sort_order $sort_order");


        $i=0;
        $result->setFetchMode(PDO::FETCH_ASSOC);

        //Сохранение полученных данных
        while ($row = $result->fetch()){
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['description'] = $row['description'];
            $categoryList[$i]['tag'] = $row['tag'];
            /**
             * TODO Удалить '/i-market/'
             */
            $categoryList[$i]['image'] = '/i-market/'.$row['image'];
            $i++;
        }
        return $categoryList;
    }

    /**
     * @param array $params
     * @return array
     * Получeние массива категорий c мин информацие {id,id - предка,тег, название,содержи детей}
     */
    public static function getCategoryMenu(array $params = array()){

        //Получение соединения с БД
        $db = DB::getConnection();

        //Результирующий массив
        $categoryList = array();

        //Переменные по умолчанию:
        //Статус активности категории
        $status = '1';
        //Метод сортировки
        $sort_order='ASC';
        //Категория предок
        $parent_cat = null;

        //Если id категории предка = null убрать часть sql запроса
        if (is_null($parent_cat)){
            $parent_cat_part=" ";
        }else{
            $parent_cat_part = " AND parent_cat = $parent_cat ";
        }

        //Запрос sql в БД
        $result = $db->query("SELECT * FROM imarket_db.im_category WHERE status = $status $parent_cat_part"
            ." ORDER BY sort_order $sort_order");

        $i=0;
        $result->setFetchMode(PDO::FETCH_ASSOC);

        //Сохранение полученных данных
        while ($row = $result->fetch()){
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['tag'] = $row['tag'];
            $categoryList[$i]['parent_cat'] = $row['parent_cat'];
            $categoryList[$i]['childs'] = ($row['child_cat'])?true:false;
            $i++;
        }
        return $categoryList;
    }

    /**
     * @param $tag - тег категории
     * @return mixed
     * Получение информации о категории по тегу
     */
    public static function getCatByTag($tag){

        //Получение соединения с БД
        $db = Db::getConnection();

        //Запрос sql в БД
        $result =$db-> query('SELECT * '
            .'FROM imarket_db.im_category '
            .'WHERE tag =\''.$tag.'\'');

        $result->setFetchMode(PDO::FETCH_ASSOC);

        //Возвращение результируещего массива
        return $result->fetch();

    }


}
