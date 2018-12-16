<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 16.12.2018
 * Time: 1:23
 */

require ROOT.'/application/views/admin/admin_header.php'; ?>

    <div class="row">
        <section>
           <p>Удалить товар №<?php echo $id;?></p>
            <form action="/i-market/admin/product/delete/<?php echo $id; ?>" method="POST">
                <input type="submit" name="submit" value="Удалить">
            </form>
        </section>
    </div>

<?php require ROOT.'/application/views/admin/admin_footer.php'; ?>