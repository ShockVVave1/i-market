<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 05.12.2018
 * Time: 12:59
 */

class SiteController extends Controller {

    public function actionIndex($array){
        $status = '1';
        $sort_order='ASC';
        $parent_cat = 0;

        extract($array);

        $getCatParams = array('status'=>$status, 'sort_order' => $sort_order,'parent_cat'=>$parent_cat);
        $getcurrentUrl = $_SERVER['REQUEST_URI'];//'\?[a-z A-z 0-9]+'
        $categories = CategoryModel::getCategory($getCatParams);
        require_once (ROOT.'/application/views/index.php');

    }
}