<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 16.12.2018
 * Time: 15:25
 */


require ROOT.'/application/views/admin/admin_header.php'; ?>


<div class="row">
    <section>
        <h2>Создание Категории</h2>
        <form action="/i-market/admin/category/create" method="POST" enctype="multipart/form-data">
            <div>
                <label for="">Название категории</label>
                <input type="text" name="name" value="">
            </div>
            <div>
                <label for="">Url тег категории</label>
                <input type="text" name="tag" value="">
            </div>
            <div>
                <label for="">Родительская категория</label>
                <select name="parent_cat" >
                    <option value="0">нет</option>
                    <?php if(is_array($categoryList))
                        foreach ($categoryList as $category ){?>
                            <?php if($category['parent_cat']==0){ ?>
                                <option value="<?php echo $category['id'];?>">
                                    <?php echo $category['name'];?>
                                </option>
                            <?php }
                        }?>
                </select>
            </div>
            <div>
                <label for="">Изображение</label>
                <input type="file" name="image" value="" accept="image/png,image/jpeg">
            </div>
            <div>
                <label for="">Описание категории</label>
                <textarea name="description"  cols="30" rows="10"></textarea>
            </div>
            <div>
                <label for="">Порядок сортировки</label>
                <input type="text" name="sort_order" value="0">
            </div>
            <div>
                <label for="">Статус</label>
                <select name="status" >
                    <option value="1" selected>Активен</option>
                    <option value="0">Выключен</option>
                </select>
            </div>

            </br>
            </br>

            <input type="submit" name="submit" value="Сохранить">
        </form>
    </section>
</div>


<?php require ROOT.'/application/views/admin/admin_footer.php'; ?>
