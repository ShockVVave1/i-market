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
     * @param $id - id продукта
     * @return mixed
     * Получение информации о продукте по id
     */
    public static function getProductById($id){

        //Получение соединения с БД
        $db = Db::getConnection();

        //Запрос sql в БД
        $result =$db-> query('SELECT * '
            .'FROM imarket_db.im_product '
            .'WHERE id =\''.$id.'\'');

        //Возвращение результируещего массива
        return $result->fetch();
    }

    /**
     * @param $params
     * @return array
     * Получение информации о продуктах по параметрам
     */
    public  static  function  getProductList(array $params){

        //Получение соединения с БД
        $db = DB::getConnection();

        //Результирующий массив
        $productsList = array();

        //Переменные по умолчанию:
        //Статус активности категории
        $status = null;
        //Метод сортировки
        $sort_order='ASC';
        //Категория предок
        $parent_cat = null;

        //Извлечение переменных
        extract($params);


        $where = "WHERE";
        if(is_null($status )&&is_null($parent_cat)){
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
        $result = $db->query("SELECT * FROM imarket_db.im_product $where $status_part $parent_cat_part"
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

        public static function getProductsByIds($idsArray)
        {

            $products = array();

            //Получение соединения с БД
            $db = Db::getConnection();

            $idsString = implode(',', $idsArray);

            $sql = "SELECT * FROM imarket_db.im_product WHERE status = 1 AND id IN ($idsString)";

            $result = $db->query($sql);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            $i = 0;
            while ($row = $result->fetch()) {
                $products[$i]['id'] = $row['id'];
                $products[$i]['name'] = $row['name'];
                $products[$i]['price'] = $row['price'];
                $i++;
            }

            return $products;
        }

        public static function deleteProductById($id){
            $db = Db::getConnection();

            $sql = "DELETE FROM imarket_db.im_product WHERE id = :id";

            $result = $db->prepare($sql);

            $result->bindParam(':id' , $id ,PDO::PARAM_INT);
            return $result->execute();
        }

        public static function createProduct($params){

            $db = DB::getConnection();

            $keys="";
            $values="";

            if(isset($params['image'])){
                $keys = "(name, tag, price, parent_cat,  status, description, image)  ";
                $values = "(:name, :tag, :price, :parent_cat, :status, :description, :image) ";
            }else{
                $keys = "(name, tag, price, parent_cat,  status, description)  ";
                $values = "(:name, :tag, :price, :parent_cat, :status, :description) ";
            }

            $sql = 'INSERT INTO imarket_db.im_product '
                .$keys
                .' VALUES '
                .$values;

            $result = $db->prepare($sql);

            $result->bindParam(':name',$params['name'],PDO::PARAM_STR);
            $result->bindParam(':tag',$params['tag'],PDO::PARAM_STR);
            $result->bindParam(':price',$params['price'],PDO::PARAM_STR);
            $result->bindParam(':parent_cat',$params['parent_cat'],PDO::PARAM_INT);
            $result->bindParam(':description',$params['description'],PDO::PARAM_STR);
            $result->bindParam(':status',$params['status'],PDO::PARAM_INT);

            if(isset($params['image'])){
                $result->bindParam(':image',$params['image'],PDO::PARAM_STR);
            }

            if($result->execute()){
                return $db->lastInsertId();
            }

            return 0;

        }

    public static function updateProduct($id, $params)
    {
        $db = Db::getConnection();

        $image=' ';
        if(isset($params['image'])){
            $image = ', image = :image ';

        }

        $sql = 'UPDATE imarket_db.im_product '
            .'SET name = :name, tag = :tag, price = :price, parent_cat = :parent_cat, status = :status, description = :description '.$image
            .' WHERE id = :id ';

        $result = $db->prepare($sql);

        $result->bindParam(':name',$params['name'],PDO::PARAM_STR);
        $result->bindParam(':tag',$params['tag'],PDO::PARAM_STR);
        $result->bindParam(':price',$params['price'],PDO::PARAM_STR);
        $result->bindParam(':parent_cat',$params['parent_cat'],PDO::PARAM_INT);
        $result->bindParam(':description',$params['description'],PDO::PARAM_STR);
        $result->bindParam(':status',$params['status'],PDO::PARAM_INT);

        if(isset($params['image'])){
            $result->bindParam(':image',$params['image'],PDO::PARAM_STR);
        }

        $result->bindParam(':id',$id,PDO::PARAM_INT);

        return $result->execute();

    }

}