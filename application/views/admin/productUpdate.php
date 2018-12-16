<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 16.12.2018
 * Time: 14:06
 */

require ROOT.'/application/views/admin/admin_header.php'; ?>

<div class="row">
    <section>
        <h2>Изменение товара</h2>
        <form action="/i-market/admin/product/update/<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
            <div>
                <label for="">Название товара</label>
                <input type="text" name="name" value="<?php echo $product['name']; ?>">
            </div>
            <div>
                <label for="">Url тег товара</label>
                <input type="text" name="tag" value="<?php echo $product['tag']; ?>">
            </div>
            <div>
                <label for="">Категория</label>
                <select name="parent_cat" >
                    <?php if(is_array($categoryList))
                        foreach ($categoryList as $category ){?>
                            <?php if($category['parent_cat']==0)continue; ?>
                            <option value="<?php echo $category['id'];?>"
                            <?php if($product['parent_cat']===$category['id']){?>
                                selected
                            <?php }?>
                            >
                                <?php echo $category['name'];?>
                            </option>
                        <?php } ?>
                </select>
            </div>
            <div>
                <label for="">Стоимость</label>
                <input type="text" name="price" value="<?php echo $product['price']; ?>">
            </div>
            <div>
                <img src="<?php echo $product['image']; ?>" alt="">
                <label for="img" >Изображение</label>
                <input id='img' type="file" name="image" value="" accept="image/png,image/jpeg">
            </div>
            <div>
                <label for="">Описание товара</label>
                <textarea name="description"  cols="30" rows="10" ><?php echo $product['description']; ?></textarea>
            </div>
            <div>
                <label for="">Статус</label>
                <select name="status" >
                    <option value="1" <?php if($product['status']===1){?>selected<?php } ?>>Активен</option>
                    <option value="0" <?php if($product['status']===0){?>selected<?php } ?>>Выключен</option>
                </select>
            </div>

            </br>
            </br>

            <input type="submit" name="submit" value="Сохранить">
        </form>
    </section>
</div>

<?php require ROOT.'/application/views/admin/admin_footer.php'; ?>
