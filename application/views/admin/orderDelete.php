<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 16.12.2018
 * Time: 22:22
 */

require ROOT.'/application/views/admin/admin_header.php'; ?>

    <div class="row">
        <section>
            <p>Удалить заказ №<?php echo $id;?></p>
            <form action="/i-market/admin/order/delete/<?php echo $id; ?>" method="POST">
                <input type="submit" name="submit" value="Удалить">
            </form>
        </section>
    </div>

<?php require ROOT.'/application/views/admin/admin_footer.php'; ?>