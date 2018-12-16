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
        $status = null;
        //Метод сортировки
        $sort_order='ASC';
        //Категория предок
        $parent_cat = null;

        extract($params);

        $where = "WHERE";
        if(is_null($status )&& is_null($parent_cat)){
            $where = "";
        }

        if (is_null($status )){
            $status_part=" ";
        }else{
            $status_part = " status = $status ";
        }

        //Если id категории предка = null убрать часть sql запроса
        if (is_null($parent_cat)){
            $parent_cat_part=" ";
        }else{
            $parent_cat_part = " AND parent_cat = $parent_cat ";
        }

        //Запрос sql в БД
        $result = $db->query("SELECT * FROM imarket_db.im_category $where $status_part $parent_cat_part"
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

    /**
     * @param $id - id категории
     * @return mixed
     * Получение информации о категории по id
     */
    public static function getCategoryById($id){

        //Получение соединения с БД
        $db = Db::getConnection();

        //Запрос sql в БД
        $result =$db-> query('SELECT * '
            .'FROM imarket_db.im_category '
            .'WHERE id =\''.$id.'\'');

        $result->setFetchMode(PDO::FETCH_ASSOC);

        //Возвращение результируещего массива
        return $result->fetch();

    }

    public static function deleteCetegoryById($id){
        $db = Db::getConnection();

        $sql = "DELETE FROM imarket_db.im_category WHERE id = :id";

        $result = $db->prepare($sql);

        $result->bindParam(':id' , $id ,PDO::PARAM_INT);
        return $result->execute();
    }


    public static function createCategory($params){

        $db = DB::getConnection();
        $keys="";
        $values="";

        if(isset($params['image'])){
            $keys = "(name, tag, parent_cat,  status, sort_order, description, image) ";
            $values = "(:name, :tag, :parent_cat, :status, :sort_order, :description, :image) ";
        }else{
            $keys = "(name, tag, parent_cat,  status, sort_order, description) ";
            $values = "(:name, :tag, :parent_cat, :status, :sort_order, :description)";
        }

        $db = DB::getConnection();

        $sql = 'INSERT INTO imarket_db.im_category '
            .$keys
            .' VALUES '
            .$values;

        $result = $db->prepare($sql);

        $result->bindParam(':name',$params['name'],PDO::PARAM_STR);
        $result->bindParam(':tag',$params['tag'],PDO::PARAM_STR);
        $result->bindParam(':parent_cat',$params['parent_cat'],PDO::PARAM_INT);
        $result->bindParam(':description',$params['description'],PDO::PARAM_STR);
        $result->bindParam(':sort_order',$params['sort_order'],PDO::PARAM_INT);
        $result->bindParam(':status',$params['status'],PDO::PARAM_INT);

        if(isset($params['image'])){
            $result->bindParam(':image',$params['image'],PDO::PARAM_STR);
        }


        if($result->execute()){
            return $db->lastInsertId();
        }

        return 0;

    }

    public static function updateCategory($id, $params)
    {
        $db = Db::getConnection();

        $image=' ';
        if(isset($params['image'])){
            $image = ', image = :image ';

        }

        $sql = 'UPDATE imarket_db.im_category '
            .'SET name = :name, tag = :tag, parent_cat = :parent_cat, status = :status, description = :description, sort_order = :sort_order'.$image
            .' WHERE id = :id ';

        $result = $db->prepare($sql);

        $result->bindParam(':name',$params['name'],PDO::PARAM_STR);
        $result->bindParam(':tag',$params['tag'],PDO::PARAM_STR);
        $result->bindParam(':parent_cat',$params['parent_cat'],PDO::PARAM_INT);
        $result->bindParam(':description',$params['description'],PDO::PARAM_STR);
        $result->bindParam(':sort_order',$params['sort_order'],PDO::PARAM_INT);
        $result->bindParam(':status',$params['status'],PDO::PARAM_INT);

        if(isset($params['image'])){
            $result->bindParam(':image',$params['image'],PDO::PARAM_STR);
        }

        $result->bindParam(':id',$id,PDO::PARAM_INT);

        return $result->execute();

    }


}
