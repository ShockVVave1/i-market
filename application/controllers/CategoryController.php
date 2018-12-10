<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 09.12.2018
 * Time: 21:08
 */

class CategoryController extends Controller{

    public function actionIndex($array){
        $status = 1;
        $sort_order='ASC';
        $tag = null;
        $parent_cat = 1;
        $child_cat=null;
        $parent_tag='';
        $child_tag='';

        extract($array);


        $getcurrentUrl = $_SERVER['REQUEST_URI'];//'\?[a-z A-z 0-9]+'

        $getCatParams = array('status'=>$status, 'sort_order' => $sort_order,'parent_cat'=>$parent_cat);
        $categories = CategoryModel::getCategory($getCatParams);

        if(intval($parent_cat)!==0){
            $getProductParams = array('status'=>$status, 'parent_cat'=>$parent_cat);
            $products = ProductModel::getProductList($getProductParams);
        }

        require_once ROOT.'/application/views/category.php';

    }

}