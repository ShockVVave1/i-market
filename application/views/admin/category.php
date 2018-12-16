<?php require ROOT.'/application/views/admin/admin_header.php'; ?>

<div class="row">
    <section>

        <a href="admin/category/create">Создать Категорию</a>
        <table style="width: 100%;">
            <tr>
                <th>ID <br> Категории</th>
                <th>Название <br>  категории</th>
                <th></th>
                <th></th>
            </tr>
            <?php foreach ($categoriesList as $category){ ?>
            <?php if($category['parent_cat']==='0'){?>

                <tr>
                    <td><?php echo $category['id']; ?></td>
                    <td><?php echo $category['name']; ?></td>
                    <td><a href="admin/category/update/<?php echo $category['id']; ?>" title="Редактировать">Редактировать</a></td>
                    <td><a href="admin/category/delete/<?php echo $category['id']; ?>" title="Удалить">x</a></td>
                </tr>

                    <?php foreach ($categoriesList as $child){
                        if ($category['id']==intval($child['parent_cat'])){ ?>
                            <tr>
                                <td><?php echo $child['id']; ?></td>
                                <td style="padding-left: 50px;"><?php echo $child['name']; ?></td>
                                <td><a href="admin/category/update/<?php echo $child['id']; ?>" title="Редактировать">Редактировать</a></td>
                                <td><a href="admin/category/delete/<?php echo $child['id']; ?>" title="Удалить">x</a></td>
                            </tr>
                        <?php }
                    }?>
            <?php }?>
            <?php }?>
        </table>
    </section>
</div>

<?php require ROOT.'/application/views/admin/admin_footer.php'; ?>