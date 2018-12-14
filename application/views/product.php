<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 11.12.2018
 * Time: 13:16
 */

/**
 * Получение отображения продукта
 */

require_once (ROOT.'/application/views/components/header.php'); ?>

<main class="main">
    <div class="container">
        <?php $breadcrumbs($params); ?>
        <div class="row">
            <aside class="col-lg-3 col-sm-12">
                <?php $sidebar($allCategories,$params); ?>
            </aside>
            <div class="col-lg-9 col-sm-12">
                <h3><?php echo $product['name']; ?></h3>
                <div class="row">
                    <div class="col-lg-5 col-sm-6" >
                       <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                    </div>
                    <div class="col-lg-5 col-sm-6" >
                        <p><?php echo $product['description']; ?></p>
                    </div>
                    <div class="col-lg-2 col-sm-12" >
                        <div class="price">Цена:<?php echo $product['price']; ?></div>
                        <a href="">В корзину</a>
                    </div>
                </div>
            </div>

            </div>
        </div>
    </div>
</main>


<?php require_once (ROOT.'/application/views/components/footer.php');?>
