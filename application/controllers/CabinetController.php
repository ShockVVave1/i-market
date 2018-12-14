<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 14.12.2018
 * Time: 19:27
 */

class CabinetController extends Controller
{
    public function actionIndex(){

        $userId = UserModel::checkLogged();
        $user = UserModel::getUserById($userId);
        require_once ROOT.'/application/views/cabinet/index.php';

        return true;
    }


}