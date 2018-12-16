<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 16.12.2018
 * Time: 18:15
 */

class AdminOrderController extends Controller
{
    public function actionIndex(){

        self::checkAdmin();

        $ordersList = OrderModel::getOrdersList();

        require ROOT . '/application/views/admin/order.php';

        return true;
    }

    public function actionView($params){

        $id = array_shift($params);

        self::checkAdmin();

        $order = OrderModel::getOrderById($id);

        $productQuantity = json_decode($order['products'], true);

        $productsIds=array();

        foreach ($productQuantity as $product){
            $productsIds[] = $product['id'];
        }

        $productsList = ProductModel::getProductsByIds($productsIds);

        $i=0;
        foreach ($productsList  as $item){
            $productsList [$i]['count'] = $productQuantity[$i]['count'];
            $i++;
        }

        if(isset($_POST['submit'])){

            $params['status'] = $_POST['status'];

            var_dump($params);
            OrderModel::changeOrderStatus($id, $params);


            header("Location: /i-market/admin/order/view/$id");
        }

        require ROOT . '/application/views/admin/orderView.php';

        return true;
    }

    public function actionDelete($params){

        $id = array_shift($params);

        self::checkAdmin();

        if(isset($_POST['submit'])){

            OrderModel::deleteOrderById($id);

            header("Location: /i-market/admin/order");
        }

        require ROOT . '/application/views/admin/orderDelete.php';

        return true;
    }


}