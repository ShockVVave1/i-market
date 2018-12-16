<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 16.12.2018
 * Time: 0:18
 */

class AdminController extends Controller
{
    public function actionIndex(){

        self::checkAdmin();

        require ROOT.'/application/views/admin/index.php';

        return true;


    }


}