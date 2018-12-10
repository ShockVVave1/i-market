<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 09.12.2018
 * Time: 16:18
 */

class CategoryModel extends Model {

    public static function getCategory($params = array()){
        $db = DB::getConnection();

        $status = 1;
        $sort_order='ASC';
        $parent_cat = null;
        extract($params);

        $categoryList = array();

        if (is_null($parent_cat)){
            $parent_cat_part=" ";
        }else{
            $parent_cat_part = " AND parent_cat = $parent_cat ";
        }

        $result = $db->query("SELECT * FROM imarket_db.im_category WHERE status = $status $parent_cat_part"
                ." ORDER BY sort_order $sort_order");

        $i=0;

        $result->setFetchMode(PDO::FETCH_ASSOC);

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

    public static function getCatByTag($tag){


        $db = Db::getConnection();

        $result =$db-> query('SELECT * '
            .'FROM imarket_db.im_category '
            .'WHERE tag =\''.$tag.'\'');

        return $result->fetch();

    }


}
