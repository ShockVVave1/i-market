<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 10.12.2018
 * Time: 18:39
 */

class ProductModel extends  Model
{
    public static function getProductByTag($tag){

        $db = Db::getConnection();

        $result =$db-> query('SELECT * '
            .'FROM imarket_db.im_product '
            .'WHERE tag =\''.$tag.'\'');

        return $result->fetch();
    }

    public  static  function  getProductList($params){

        $db = DB::getConnection();

        $status = 1;
        $sort_order='ASC';
        $parent_cat = null;
        extract($params);

        $productsList = array();

        if (is_null($parent_cat)){
            $parent_cat_part=" ";
        }else{
            $parent_cat_part = " AND parent_cat = $parent_cat ";
        }

        $result = $db->query("SELECT * FROM imarket_db.im_product WHERE status = $status $parent_cat_part"
            ." ORDER BY name $sort_order");

        $result->setFetchMode(PDO::FETCH_ASSOC);

        $i=0;

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