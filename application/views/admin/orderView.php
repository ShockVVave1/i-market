<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 16.12.2018
 * Time: 18:48
 */


require ROOT.'/application/views/admin/admin_header.php'; ?>


<div class="row">
    <section>
        <h2>Просмотр заказа № <?php echo $id; ?></h2>

        <table style="width: 100%;">
            <tr>
                <td>Номер заказа:</td>
                <td><?php echo $order['id']; ?></td>
            </tr>
            <tr>
                <td>ID пользователя:</td>
                <td><?php echo $order['user_id']; ?></td>
            </tr>
            <tr>
                <td>Имя пользователя:</td>
                <td><?php echo $order['fullname']; ?></td>
            </tr>
            <tr>
                <td>Дата и время заказа:</td>
                <td><?php echo $order['order_date']; ?></td>
            </tr>

            <tr>
                <td>Сумма заказа:</td>
                <td><?php echo $order['amount']; ?></td>
            </tr>

            <tr>
                <td>Телефон:</td>
                <td><?php echo $order['tel']; ?></td>
            </tr>

            <tr>
                <td>Комментарий:</td>
                <td><?php echo $order['message']; ?></td>
            </tr>
        </table>

        <form action="/i-market/admin/order/view/<?php echo $id; ?>" method="POST">
            <label for="">Статус заказа</label>
            <select name="status" >
                <option value="1" <?php if($order['status']==1){ ?>selected<?php } ?>>В обработке</option>
                <option value="2" <?php if($order['status']==2){ ?>selected<?php } ?>>Отправлен</option>
                <option value="3" <?php if($order['status']==3){ ?>selected<?php } ?>>Закрыт</option>
                <option value="4" <?php if($order['status']==4){ ?>selected<?php } ?>>Отменен</option>
            </select>
            <input type="submit" name="submit" value="Сохранить">

        </form>
        <table style="width: 100%;">
            <tr>
                <th>ID товара</th>
                <th>Название товара</th>
                <th>Цена</th>
                <th>Кол-во</th>
            </tr>
            <?php   foreach ($productsList as $product){?>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $product['price']; ?></td>
                    <td><?php echo $product['count']; ?></td>
                </tr>
            <?php }?>
        </table>
    </section>
</div>


<?php require ROOT.'/application/views/admin/admin_footer.php'; ?>
