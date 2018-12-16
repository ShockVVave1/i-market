<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 15.12.2018
 * Time: 17:53
 */


require_once (ROOT.'/application/views/components/header.php'); ?>

<main class="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-sm-12">
                <h3>Корзина</h3>
                <?php if($productsInCart){?>
                <table class = "cart_table">
                    <tr>
                        <th>Название</th>
                        <th></th>
                        <th>Количество</th>
                        <th></th>
                        <th>Стоимость</th>
                        <th></th>
                    </tr>
                    <?php foreach ($products as $product){?>
                        <tr>
                            <td><?php echo $product['name']; ?></td>
                            <td><a class='add-button btn btn-warning' href="cart/remove/<?php echo $product['id']; ?>">-</a></td>
                            <td><?php echo $productsInCart[$product['id']]; ?></td>
                            <td><a class='add-button btn btn-success' href="cart/add/<?php echo $product['id']; ?>">+</a></td>
                            <td><?php echo $product['price']; ?></td>
                            <td><a class='add-button btn btn-danger' href="cart/kill/<?php echo $product['id']; ?>">x</a></td>
                        </tr>
                    <?php }?>
                    <tr>
                        <td colspan="4">Общая стоимость</td>
                        <td><?php echo $totalPrice; ?></td>
                    </tr>
                    </table>
                    <div style="margin-top: 15px;">
                        <a class="btn btn-danger" href="cart/clear">Отчистить корзину</a>
                        <a class="btn btn-success" href="cart/checkout">Оформить</a>
                    </div>

                <?php }else{?>
                    <p>Корзина пуста </p>
                <?php } ?>

            </div>

        </div>
    </div>
    </div>
</main>


<?php require_once (ROOT.'/application/views/components/footer.php');?>
