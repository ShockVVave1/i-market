<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 10.12.2018
 * Time: 18:39
 */

/**
 * Class ProductModel
 * Модель для работы с информацией о продуктах из БД
 */
class ProductModel extends  Model
{
    /**
     * @param $tag - тег продукта
     * @return mixed
     * Получение информации о продукте по тегу
     */
    public static function getProductByTag($tag){

        //Получение соединения с БД
        $db = Db::getConnection();

        //Запрос sql в БД
        $result =$db-> query('SELECT * '
            .'FROM imarket_db.im_product '
            .'WHERE tag =\''.$tag.'\'');

        //Возвращение результируещего массива
        return $result->fetch();
    }

    /**
     * @param $params
     * @return array
     * Получение информации о продуктах по параметрам
     */
    public  static  function  getProductList($params){

        //Получение соединения с БД
        $db = DB::getConnection();

        //Результирующий массив
        $productsList = array();

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
        $result = $db->query("SELECT * FROM imarket_db.im_product WHERE status = $status $parent_cat_part"
            ." ORDER BY name $sort_order");

        $result->setFetchMode(PDO::FETCH_ASSOC);

        $i=0;
        //Сохранение полученных данных
        while ($row = $result->fetch()){
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['description'] = $row['description'];
            $productsList[$i]['tag'] = $row['tag'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['count'] = $row['count'];
            $productsList[$i]['parent_cat'] = $row['parent_cat'];
            $productsList[$i]['date_add'] = $row['date_add'];
            /**
             * TODO Удалить '/i-market/'
             */
            $productsList[$i]['image'] = '/i-market/'.$row['image'];
            $i++;
        }
        return $productsList;
    }
}