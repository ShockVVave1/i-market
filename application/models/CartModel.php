<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 15.12.2018
 * Time: 15:00
 */

class CartModel extends Model
{

    public static function Add($product_id){

        $product_id = intval($product_id);

        $cart = array();
        if(isset($_SESSION['cart'])){
            $cart = $_SESSION['cart'];
        }

        if(array_key_exists($product_id, $cart)){
            $cart[$product_id]++;
        }else{
            $cart[$product_id] = 1;
        }

        $_SESSION['cart'] = $cart;

        return true;

    }

    public static function Kill($product_id){

        $product_id = intval($product_id);

        $cart = array();
        if(isset($_SESSION['cart'])){
            $cart = $_SESSION['cart'];
        }

        if(array_key_exists($product_id, $cart)){
            unset($cart[$product_id]);
        }

        $_SESSION['cart'] = $cart;

        return true;

    }

    public static function Remove($product_id){

        $product_id = intval($product_id);

        $cart = array();
        if(isset($_SESSION['cart'])){
            $cart = $_SESSION['cart'];
        }

        if(array_key_exists($product_id, $cart)){
            if($cart[$product_id]>1){
                $cart[$product_id]--;
            }else{
                unset($cart[$product_id]);
            }

        }

        $_SESSION['cart'] = $cart;

        return true;
    }

    public static function getCount(){

        if(isset($_SESSION['cart'])){
            $count = 0;
            foreach (($_SESSION['cart']) as $ket => $value){
                $count = $count + $value;
            }
            return $count;
        }else{
            return 0;
        }
    }

    public static function getCartProducts(){
        if(isset($_SESSION['cart'])){
            return $_SESSION['cart'];
        }
        return false;
    }

    public static function getTotalPrice($products){
        $total = 0;

        $productsInCart = self::getCartProducts();

        if($productsInCart){
            foreach ($products as $item){
                $total += $item['price']*$productsInCart[$item['id']];
            }
        }

        return $total;

    }

    public static function Clear(){

        if (isset($_SESSION['cart'])){
            unset($_SESSION['cart']);
        }

        return true;

    }



}