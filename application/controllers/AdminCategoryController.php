<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 16.12.2018
 * Time: 14:27
 */

class AdminCategoryController extends Controller
{

    public function actionIndex(){

        self::checkAdmin();

        $categoriesList = CategoryModel::getCategoryMenu(array());

        require ROOT . '/application/views/admin/category.php';

        return true;
    }

    public function actionDelete($params){

        $id = array_shift($params);

        self::checkAdmin();

        if(isset($_POST['submit'])){

            CategoryModel::deleteCetegoryById($id);

            header("Location: /i-market/admin/category");
        }

        require ROOT . '/application/views/admin/categoryDelete.php';

        return true;
    }

    public function actionCreate(){

        self::checkAdmin();

        $categoryList = CategoryModel::getCategoryMenu();

        if(isset($_POST['submit'])){

            $params['name'] = $_POST['name'];
            $params['tag'] = $_POST['tag'];
            $params['parent_cat'] = $_POST['parent_cat'];
            $params['sort_order'] = $_POST['sort_order'];
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


            $id = CategoryModel::createCategory($params);

            if($id && $_FILES['image']['name']!=null){

                if (is_uploaded_file($_FILES['image']['tmp_name'])){

                    move_uploaded_file($_FILES['image']['tmp_name'], ROOT.'/'.$uploadfile);
                }

            }

            header("Location: /i-market/admin/category");
        }

        require ROOT . '/application/views/admin/categoryCreate.php';

        return true;
    }

    public function actionUpdate($params){

        $id = array_shift($params);

        self::checkAdmin();

        $categoryList = CategoryModel::getCategoryMenu();

        $CurCategory = CategoryModel::getCategoryById($id);

        if(isset($_POST['submit'])){

            $params['name'] = $_POST['name'];
            $params['tag'] = $_POST['tag'];
            $params['parent_cat'] = $_POST['parent_cat'];
            $params['sort_order'] = $_POST['sort_order'];
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


            $id = CategoryModel::updateCategory($id, $params);

            if($id && $_FILES['image']['name']!=null){

                if (is_uploaded_file($_FILES['image']['tmp_name'])){

                    move_uploaded_file($_FILES['image']['tmp_name'], ROOT.'/'.$uploadfile);
                }

            }

            header("Location: /i-market/admin/category");
        }

        require ROOT . '/application/views/admin/categoryUpdate.php';

        return true;
    }

}