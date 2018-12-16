<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 16.12.2018
 * Time: 12:56
 */
require ROOT.'/application/views/admin/admin_header.php'; ?>

<div class="row">
    <section>
       <h2>Создание товара</h2>
        <form action="/i-market/admin/product/create" method="POST" enctype="multipart/form-data">
            <div>
                <label for="">Название товара</label>
                <input type="text" name="name" value="">
            </div>
            <div>
                <label for="">Url тег товара</label>
                <input type="text" name="tag" value="">
            </div>
            <div>
                <label for="">Категория</label>
                <select name="parent_cat" >
                    <?php if(is_array($categoryList))
                        foreach ($categoryList as $category ){?>
                            <?php if($category['parent_cat']==0)break; ?>
                            <option value="<?php echo $category['id'];?>">
                                <?php echo $category['name'];?>
                            </option>
                    <?php } ?>
                </select>
            </div>
            <div>
                <label for="">Стоимость</label>
                <input type="text" name="price" value="">
            </div>
            <div>
                <label for="img">Изображение</label>
                <input id='img' type="file" name="image" value="" accept="image/png,image/jpeg">
            </div>
            <div>
                <label for="">Описание товара</label>
                <textarea name="description"  cols="30" rows="10"></textarea>
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
