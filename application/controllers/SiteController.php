<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 05.12.2018
 * Time: 12:59
 */

class SiteController extends Controller {

    public function actionIndex($array){

        extract($array);
        $getCatParams = array('status'=>'1', 'sort_order' => 'ASC','parent_cat'=>0);
        $getcurrentUrl = preg_replace('\?[a-z A-z 0-9]+','',$_SERVER['REQUEST_URI']);
        $categories = CategoryModel::getCategory($getCatParams);
        require_once (ROOT.'/application/views/index.php');

    }
}