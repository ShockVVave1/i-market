<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 15.12.2018
 * Time: 20:14
 */


require_once (ROOT.'/application/views/components/header.php'); ?>

<main class="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-sm-12">
                <h3>Оформление заказа</h3>
                <?php if($result){?>
                   <p>Заказ удачно офрмлен</p>
                <?php }else{?>
                    <p>Выбрано товаров: <?php echo $totalQuantity; ?> на сумму: <?php echo $totalPrice;?> </p>
                <?php } ?>

                <?php if(!$result){

                    if(isset($errors)&&is_array($errors)){?>
                        <ul>
                            <?php foreach ($errors as $error){ ?>
                                <li>-<?php echo $error; ?></li>
                            <?php } ?>
                        </ul>
                    <?php   } ?>

                    <p>Для оформления заказа заполните форму.</p>

                    <div>
                        <form action="cart/checkout" method="POST">
                            <label for="">Ваше имя</label>
                            <input type="text" name="userName" value="<?php echo $userName; ?>">
                            <label for="">Номер телефона</label>
                            <input type="text" name="userPhone" value="<?php echo $userPhone; ?>">
                            <label for="">Комментарий</label>
                            <input type="text" name="userComment" value="<?php echo $userComment; ?>">

                            <input type="submit" name="submit" class="btn btn-success" value="Оформить">
                        </form>
                    </div>
                <?php } ?>


            </div>

        </div>
    </div>
    </div>
</main>


<?php require_once (ROOT.'/application/views/components/footer.php');?>
