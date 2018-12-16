<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 16.12.2018
 * Time: 0:21
 */

require ROOT.'/application/views/admin/admin_header.php'; ?>

<div class="row">
    <section>
        <ul>
            <li><a href="admin/product">Работать с товарами</a></li>
            <li><a href="admin/category">Работать с категориями</a></li>
            <li><a href="admin/order">Заказы</a></li>
        </ul>
    </section>
</div>

<?php require ROOT.'/application/views/admin/admin_footer.php'; ?>