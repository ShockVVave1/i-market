<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 16.12.2018
 * Time: 0:58
 */

class AdminProductController extends Controller
{


    public function actionIndex(){

        self::checkAdmin();

        $productsList = ProductModel::getProductList(array());

        require ROOT.'/application/views/admin/products.php';

        return true;
    }

    public function actionDelete($params){

        $id = array_shift($params);

        self::checkAdmin();

        if(isset($_POST['submit'])){

            ProductModel::deleteProductById($id);

            header("Location: /i-market/admin/product");
        }

        require ROOT . '/application/views/admin/productDelete.php';

        return true;
    }

    public function actionCreate(){

        self::checkAdmin();

        $categoryList = CategoryModel::getCategoryMenu();
        if(isset($_POST['submit'])){

            $params['name'] = $_POST['name'];
            $params['tag'] = $_POST['tag'];
            $params['parent_cat'] = $_POST['parent_cat'];
            $params['price'] = $_POST['price'];
            $params['description'] = $_POST['description'];
            $params['status'] = $_POST['status'];

            $uploaddir = 'public/image/';
            $uploadfile = $uploaddir .uniqid(). basename($_FILES['image']['name']);

            if($_FILES['image']['name']!=null){

                $params['image'] = $uploadfile;
            }

            $errors = false;

            if(!isset($params['name'])||empty($params['name'])){
                $errors[]='Заполните название';
            }

            if(!isset($params['tag'])||empty($params['tag'])){
                $errors[]='Заполните url тег';
            }


            $id = ProductModel::createProduct($params);

            if($id && $_FILES['image']['name']!=null){

                if (is_uploaded_file($_FILES['image']['tmp_name'])){

                    move_uploaded_file($_FILES['image']['tmp_name'], ROOT.'/'.$uploadfile);
                }

            }

            header("Location: /i-market/admin/product");
        }

        require ROOT . '/application/views/admin/productCreate.php';

        return true;
    }

    public function actionUpdate($params){

        $id = array_shift($params);

        self::checkAdmin();

        $categoryList = CategoryModel::getCategoryMenu();

        $product = ProductModel::getProductById($id);
        
        if(isset($_POST['submit'])){

            $params['name'] = $_POST['name'];
            $params['tag'] = $_POST['tag'];
            $params['parent_cat'] = $_POST['parent_cat'];
            $params['price'] = $_POST['price'];
            $params['description'] = $_POST['description'];
            $params['status'] = $_POST['status'];

            $uploaddir = 'public/image/';
            $uploadfile = $uploaddir .uniqid(). basename($_FILES['image']['name']);

            if($_FILES['image']['name']!=null){

                $params['image'] = $uploadfile;
            }

            $errors = false;

            if(!isset($params['name'])||empty($params['name'])){
                $errors[]='Заполните название';
            }

            if(!isset($params['tag'])||empty($params['tag'])){
                $errors[]='Заполните url тег';
            }


            $id = ProductModel::updateProduct($id, $params);

            if($id && $_FILES['image']['name']!=null){

                if (is_uploaded_file($_FILES['image']['tmp_name'])){

                    move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile);
                }

            }

            header("Location: /i-market/admin/product");
        }

        require ROOT . '/application/views/admin/productUpdate.php';

        return true;
    }



}