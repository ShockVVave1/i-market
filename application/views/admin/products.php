<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 16.12.2018
 * Time: 1:06
 */

require ROOT.'/application/views/admin/admin_header.php'; ?>

    <div class="row">
        <section>

            <a href="admin/product/create">Создать товар</a>
            <table style="width: 100%;">
                <tr>
                    <th>ID <br> товара</th>
                    <th>Название <br> товара</th>
                    <th>Цена</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($productsList as $product){?>
                    <tr>
                        <td><?php echo $product['id']; ?></td>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['price']; ?></td>
                        <td><a href="admin/product/update/<?php echo $product['id']; ?>" title="Редактировать">Редактировать</a></td>
                        <td><a href="admin/product/delete/<?php echo $product['id']; ?>" title="Удалить">x</a></td>
                    </tr>
                <?php }?>
            </table>
        </section>
    </div>

<?php require ROOT.'/application/views/admin/admin_footer.php'; ?>