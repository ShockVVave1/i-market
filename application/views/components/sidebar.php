<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 12.12.2018
 * Time: 23:32
 */

/**
 * Получение html кода sidebar
 */
?>

<h3>Категории</h3>
<ul class="sidemenu">

    <?php $i=0;
    $curerent_url = '/i-market';
    foreach($params['tags'] as $tag){
        $curerent_url.='/'.$tag;
    }
    foreach ($allCategories as $category){ ?>

        <?php if($category['parent_cat']==='0'){?>
            <li>
                <?php if($curerent_url!=='/i-market/'.$category['tag']){ ?>
                    <a href="<?php echo '/i-market/'.$category['tag'];?>"><?php echo $category['name']; ?></a>
                <?php }else{ ?>
                    <?php echo $category['name']; ?>
                <?php } ?>
                <?php  if($category['childs']){?>
                    <ul>
                    <?php foreach ($allCategories as $child){
                        if ($category['id']==intval($child['parent_cat'])){ ?>
                            <?php if($curerent_url!=='/i-market/'.$category['tag'].'/'.$child['tag']){ ?>
                                <li><a href="<?php echo '/i-market/'.$category['tag'].'/'.$child['tag'];?>"><?php echo $child['name']; ?></a></li>
                            <?php }else{ ?>
                                <li><?php echo $child['name']; ?></li>
                            <?php } ?>
                        <?php }
                    }?>
                    </ul>
                <?php }?>
            </li>
        <?php }?>
    <?php $i++;
    }?>
</ul>
