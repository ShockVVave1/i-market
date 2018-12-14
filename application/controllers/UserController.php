<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 14.12.2018
 * Time: 15:21
 */

/**
 * Class UserController
 * Контроллер обеспечивающий работу с польщователями
 */
class UserController extends Controller
{
    /**
     * Функция регистрации нового пользователя
     */
    public function actionRegister($params){

        $login='';
        $password='';
        $email='';


        if(isset($_POST['submit'])){
            $login = $_POST['login'];
            $password  = $_POST['password'];
            $email = $_POST['email'];

            $errors=false;

            if(!UserModel::checkName($login)){
                $errors[]='Логин не должно быть короче 2-х символов';
            }

            if(!UserModel::checkSymbols($login)){
                $errors[]='Логин содержит не допутимые символы';
            }

            if(!UserModel::checkEmail($email)){
                $errors[]='Неправильный email';
            }

            if(!UserModel::checkPassword($password)){
                $errors[]='Пароль не должен быть короче 6-ти символов';
            }

            if(UserModel::checkEmailExists($email)){
                $errors[]='Данная почта уже зарегестрирована';
            }

            if ($errors==false){
                $hash_password = password_hash($password,PASSWORD_DEFAULT);
                $result = UserModel::register($login,$email,$hash_password);
            }

        }

            require ROOT.'/application/views/user/register.php';

        return true;

    }

    public function actionLogin(){
        $password='';
        $email='';


        if(isset($_POST['submit'])){
            $password  = $_POST['password'];
            $email = $_POST['email'];

            $errors=false;

            if(!UserModel::checkEmail($email)){
                $errors[]='Неправильный email';
            }

            $userId = UserModel::checkUserDate($email,$password);

            if($userId == false){
                $errors[]='Неправильные данные для входа на сайт';
            }else{
                UserModel::auth($userId);

                header("Location: /i-market/cabinet/");

            }

        }
        require (ROOT.'/application/views/user/login.php');

        return true;
    }

    /**
     *  Функция выхода из авторизованного аккаунта
     */
    public function actionLogout(){

        UserModel::logout();
        header("Location: /i-market/user/login");
        return true;

    }

}