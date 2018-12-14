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

        $sql = 'INSERT INTO imarket_db.im_users (login, email, password) '
            .'VALUES (:login, :email, :password)';

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
        }
        return false;
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

}