<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 16.12.2018
 * Time: 18:18
 */

require ROOT.'/application/views/admin/admin_header.php'; ?>

    <div class="row">
        <section>
            <table style="width: 100%;">
                <tr>
                    <th>ID <br> заказа</th>
                    <th>ID <br> пользователя</th>
                    <th>Имя <br> покупателя</th>
                    <th>Телефон <br> покупателя</th>
                    <th>Сумма<br>  заказа</th>
                    <th>Дата <br> оформления</th>
                    <th>Статус</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($ordersList as $order){?>
                    <tr>
                        <td><?php echo $order['id']; ?></td>
                        <td><?php echo $order['user_id']; ?></td>
                        <td><?php echo $order['fullname']; ?></td>
                        <td><?php echo $order['tel']; ?></td>
                        <td><?php echo $order['amount']; ?></td>
                        <td><?php echo $order['order_date']; ?></td>
                        <td><?php echo $order['status']; ?></td>
                        <td><a href="admin/order/view/<?php echo $order['id']; ?>" title="Смотреть">Смотреть</a></td>
                        <td><a href="admin/order/delete/<?php echo $order['id']; ?>" title="Удалить">x</a></td>
                    </tr>
                <?php }?>
            </table>
        </section>
    </div>

<?php require ROOT.'/application/views/admin/admin_footer.php'; ?>