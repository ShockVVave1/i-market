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
        $parent_cat = 0;
        extract($params);

        $categoryList = array();

        $result = $db->query("SELECT * FROM imarket_db.im_category WHERE status = $status AND parent_cat = $parent_cat "
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


}
