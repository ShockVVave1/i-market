<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 14.12.2018
 * Time: 15:42
 */

class UserModel
{

    public static function register($login,$email,$password){

        $db = DB::getConnection();

        $sql = 'INSERT INTO imarket_db.im_users (login, email, password, role) '
            .'VALUES (:login, :email, :password, :role)';

        $result = $db->prepare($sql);
        $result->bindParam(':login',$login, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);

        return $result->execute();
    }

    /**
     * @param $name
     * @return bool
     * Функция по проверки имени на валидность
     */
    public  static function checkName($name){
        if(strlen($name)>2){
            return true;
        }else{
            return false;
        }
    }

    public static function checkSymbols($name){
        if(preg_match("#^[aA-zZ0-9-_]+$#",$name)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param $password
     * @return bool
     * Функция по проверки пароля на валидность
     */
    public  static function checkPassword($password){
        if(strlen($password)>=6){
            return true;
        }
        return false;
    }

    /**
     * @param $email
     * @return bool
     * Функция проверки почты на валидность
     */
    public  static function checkEmail($email){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        return false;
    }

    /**
     * @param $phone
     * @return bool
     * Функция проверки мобильного телефона
     */
    public  static function checkPhone($phone){
        if (preg_match('/((8|\+7)-?)?\(?\d{3,5}\)?-?\d{1}-?\d{1}-?\d{1}-?\d{1}-?\d{1}((-?\d{1})?-?\d{1})?/', $phone)) {
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param $email
     * @return bool
     * Функция проверки почты на уникальность
     */
    public static function checkEmailExists($email){

        $db = DB::getConnection();

        $sql = 'SELECT COUNT(*) FROM imarket_db.im_users WHERE email = :email';

        $result = $db->prepare($sql);
        $result -> bindParam(':email',$email, PDO::PARAM_STR);
        $result ->execute();

        if($result->fetchColumn())
            return true;
        return false;
    }

    /**
     * @param $userId
     * Авторизация пользователя
     */
    public  static function auth($userId){

        $_SESSION['user'] = $userId;

    }

    /**
     * @return mixed
     * Проверка авторизованности пользователя c перенаправлением
     */
    public static function checkLogged(){

        if(isset($_SESSION['user'])){
            return $_SESSION['user'];
        }

        header("Location: /i-market/user/login");
    }

    /**
     * @return bool
     * Проверка авторизованности пользователя с возвращением флага
     */
    public static function isGuest(){

        if(isset($_SESSION['user'])){
            return true;
        }
        return false;

    }

    /**
     * Функция разлогивания пользователя
     */
    public static function logout(){
        if(isset($_SESSION['user'])){
            unset($_SESSION['user']);
        }

        return true;
    }

    /**
     * @param $email
     * @param $password
     * @return bool
     * Аутентификация пользователя
     */
    public  static function checkUserDate($email,$password){

        $db = DB::getConnection();

        $sql = 'SELECT * FROM imarket_db.im_users WHERE  email = :email;';

        $result = $db->prepare($sql);
        $result->bindParam(':email',$email, PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();
        if($user){
            if( password_verify($password , $user['password'])){
                return $user['id'];
            }
        }

        return false;
    }

    /**
     * @param $userId
     * @return mixed
     * Получения данных пользователя по id
     */
    public static function getUserById($userId){


        if($userId){
            $db = DB::getConnection();

            $sql='SELECT * FROM imarket_db.im_users WHERE id = :id';

            $result = $db->prepare($sql);
            $result -> bindParam(':id',$userId,PDO::PARAM_INT);

            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();

            return $result->fetch();
        }
    }

}