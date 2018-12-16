<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 15.12.2018
 * Time: 14:57
 */

class CartController extends Controller
{

    public function actionIndex(){

        $productsInCart = CartModel::getCartProducts();

        if($productsInCart){
            $productsIds = array_keys($productsInCart);
            $products = ProductModel::getProductsByIds($productsIds);

            $totalPrice = CartModel::getTotalPrice($products);
        }

        require ROOT.'/application/views/cart.php';

        return true;
    }

    public function actionAdd($params){

        CartModel::Add(array_shift($params));
        $referer = $_SERVER['HTTP_REFERER'];
        header("Location: $referer");
        return true;

    }

    public function actionRemove($params){

        echo 'removeCo';
        CartModel::Remove(array_shift($params));
        $referer = $_SERVER['HTTP_REFERER'];
        header("Location: $referer");
        return true;

    }

    public function actionKill($params){

        CartModel::Kill(array_shift($params));
        $referer = $_SERVER['HTTP_REFERER'];
        header("Location: $referer");
        return true;

    }

    public function actionClear(){

        CartModel::Clear();

        $referer = $_SERVER['HTTP_REFERER'];
        header("Location: $referer");
        return true;
    }

    public function actionAddAjax(){
        $product_id = $_POST['product_id'];
        CartModel::Add($product_id);
        $count = CartModel::getCount();
        $ajaxUnswer = array('count' => $count);
        echo (json_encode($ajaxUnswer));
        return true;

    }

    public function actionCheckout(){

        $result = false;

        if(isset($_POST['submit'])){

            $userName = strip_tags(trim($_POST['userName']));
            $userPhone = $_POST['userPhone'];
            $userComment = strip_tags(trim($_POST['userComment']));

            $productsInCart = CartModel::getCartProducts();

            $productsIds = array_keys($productsInCart);
            $products = ProductModel::getProductsByIds($productsIds);

            $i=0;
            foreach ($products as $item){
                $products[$i]['count'] = $productsInCart[$item['id']];
                $i++;

            }

            $totalPrice = CartModel::getTotalPrice($products);
            $totalQuantity = CartModel::getCount();

            $errors = false;

            if(!UserModel::checkName($userName))
                $errors[]='Неправильное имя';
            if(!UserModel::checkPhone($userPhone))
                $errors[]='Неправильный телефон';

            if($errors == false){

                if(UserModel::isGuest()){
                    $userId=$_SESSION['user'];
                }else{
                    $userId=UserModel::checkLogged();
                }


                $result = OrderModel::save($userId,$userName, $userPhone, $totalPrice, $userComment, $products);

                if($result){
                    CartModel::Clear();
                    $totalQuantity = 0;
                }
            }
        }else{
                $productsInCart = CartModel::getCartProducts();

                if ($productsInCart==false){
                    header("Location:/");
                }else{

                    $productsIds = array_keys($productsInCart);
                    $products = ProductModel::getProductsByIds($productsIds);
                    $totalPrice = CartModel::getTotalPrice($products);
                    $totalQuantity = CartModel::getCount();

                    $userName = false;
                    $userPhone = false;
                    $userComment = false;

                    if(UserModel::isGuest()){

                    }else{

                        $userId = UserModel::checkLogged();
                        $user = UserModel::getUserById($userId);

                        $userName = $user['name'];
                    }

                }
            }

            require ROOT.'/application/views/checkout.php';

            return true;
        }





}