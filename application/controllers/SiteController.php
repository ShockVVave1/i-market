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
        require_once (ROOT.'/application/views/index.php');

    }
}