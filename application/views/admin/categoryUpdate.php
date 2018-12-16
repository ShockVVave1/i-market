<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 16.12.2018
 * Time: 16:01
 */


require ROOT.'/application/views/admin/admin_header.php'; ?>


<div class="row">
    <section>
        <h2>Создание Категории</h2>
        <form action="/i-market/admin/category/update/<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
            <div>
                <label for="">Название категории</label>
                <input type="text" name="name" value="<?php echo $CurCategory['name']; ?>">
            </div>
            <div>
                <label for="">Url тег категории</label>
                <input type="text" name="tag" value="<?php echo $CurCategory['tag']; ?>">
            </div>
            <div>
                <label for="">Родительская категория</label>
                <select name="parent_cat" >
                    <option value="0">нет</option>
                    <?php if(is_array($categoryList))
                        foreach ($categoryList as $category ){?>
                            <?php if($category['parent_cat']==0){ ?>
                                <option value="<?php echo $category['id'];?>"
                                    <?php if($CurCategory['parent_cat']===$category['id']){?>
                                        selected
                                    <?php }?>>
                                    <?php echo $category['name'];?>
                                </option>
                            <?php }
                        }?>
                </select>
            </div>
            <div>
                <img src="<?php echo $CurCategory['image']; ?>" alt="">
                <label for="">Изображение</label>
                <input type="file" name="image" value="" accept="image/png,image/jpeg">
            </div>
            <div>
                <label for="">Описание категории</label>
                <textarea name="description"  cols="30" rows="10"><?php echo $CurCategory['description']; ?></textarea>
            </div>
            <div>
                <label for="">Порядок сортировки</label>
                <input type="text" name="sort_order" value="<?php echo $CurCategory['sort_order']; ?>">
            </div>
            <div>
                <label for="">Статус</label>
                <select name="status" >
                    <option value="1" <?php if($CurCategory['status']===1){?>selected<?php } ?>>Активен</option>
                    <option value="0" <?php if($CurCategory['status']===0){?>selected<?php } ?>>Выключен</option>
                </select>
            </div>

            </br>
            </br>

            <input type="submit" name="submit" value="Сохранить">
        </form>
    </section>
</div>


<?php require ROOT.'/application/views/admin/admin_footer.php'; ?>
