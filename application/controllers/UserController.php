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
class UserController
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
                $errors[]='Имя не должно быть короче 2-х символов';
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

}