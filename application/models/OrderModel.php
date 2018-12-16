<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 15.12.2018
 * Time: 20:50
 */

class OrderModel extends Model
{
    public static function save( $userId,$userName, $userPhone, $totalPrice, $userComment, $products){

        $products = json_encode($products);

        $db = Db::getConnection();

        $sql = 'INSERT INTO imarket_db.im_orders (user_id, fullname, tel, amount, products,  message ) '
            .'VALUES (:user_id, :fullname, :tel, :amount, :products,  :message )';

        $result = $db->prepare($sql);

        $result->bindParam(':user_id',$userId, PDO::PARAM_STR);
        $result->bindParam(':fullname',$userName, PDO::PARAM_STR);
        $result->bindParam(':tel',$userPhone, PDO::PARAM_STR);
        $result->bindParam(':amount',$totalPrice, PDO::PARAM_STR);
        $result->bindParam(':products',$products, PDO::PARAM_STR);
        $result->bindParam(':message',$userComment, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function getOrdersList(){

        $ordersList = array();

        $db = Db::getConnection();

        $result = $db->query('SELECT * FROM imarket_db.im_orders ORDER BY order_date ASC');

        $i = 0;
        while ($row = $result->fetch()){
            $ordersList[$i]['id'] = $row['id'];
            $ordersList[$i]['user_id'] = $row['user_id'];
            $ordersList[$i]['fullname'] = $row['fullname'];
            $ordersList[$i]['order_date'] = $row['order_date'];
            $ordersList[$i]['amount'] = $row['amount'];
            $ordersList[$i]['products'] = $row['products'];
            $ordersList[$i]['tel'] = $row['tel'];
            $ordersList[$i]['message'] = $row['message'];
            $ordersList[$i]['status'] = $row['status'];
            $i++;
        }
        return $ordersList;

    }

    /**
     * @param $id - id заказа
     * @return mixed
     * Получение информации о заказе по id
     */
    public static function getOrderById($id){

        //Получение соединения с БД
        $db = Db::getConnection();

        //Запрос sql в БД
        $result =$db-> query('SELECT * '
            .'FROM imarket_db.im_orders '
            .'WHERE id =\''.$id.'\'');

        $result->setFetchMode(PDO::FETCH_ASSOC);

        //Возвращение результируещего массива
        return $result->fetch();

    }

    public static function changeOrderStatus($id, $params)
    {
        //Получение соединения с БД
        $db = Db::getConnection();

        $sql = "UPDATE imarket_db.im_orders SET status = :status WHERE id = :id";
        //Запрос sql в БД

        $result = $db->prepare($sql);

        $result->bindParam(':status', $params['status'],PDO::PARAM_INT);

        $result->bindParam(':id',$id,PDO::PARAM_INT);

        return $result->execute();

    }

    public static function deleteOrderById($id){
        $db = Db::getConnection();

        $sql = 'DELETE FROM imarket_db.im_orders WHERE id = :id';

        $result = $db->prepare($sql);

        $result->bindParam(':id',$id,PDO::PARAM_STR);

        return $result->execute();
    }


}