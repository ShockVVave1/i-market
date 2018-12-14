<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 07.12.2018
 * Time: 12:41
 */

/**
 * Получение отображения главной страницы
 */

require_once (ROOT.'/application/views/components/header.php'); ?>

<main class="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <?php foreach ($categories as $category){?>
                    <div class="cat_cart clearfix">
                        <h3><a href="<?php echo $getcurrentUrl.$category['tag']; ?>"><?php echo $category['name']; ?></a></h3>
                        <div>
                            <a class='cat_img' href="">
                                <img src="<?php echo $category['image']; ?>" alt="<?php echo $category['name']; ?>">
                            </a>
                            <p><?php echo $category['description']; ?></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</main>




<?php require_once (ROOT.'/application/views/components/footer.php');