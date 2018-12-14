<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 11.12.2018
 * Time: 15:12
 */

/**
 * Получение html кода хлебных крошек
 */
?>

<div class="breadcrumb">
    <ul>
        <?php
            $crumbs = '/i-market';
            $i=0;
        ?>
        <li>
            <a href="<?php echo $crumbs; ?>">Home</a>
        </li>
        <li>/</li>
        <?php foreach($params['tags'] as $tag){
            $crumbs.='/'.$tag;?>

                    <?php if(next($params['tags'])){ ?>
                        <li>
                            <a href="<?php echo $crumbs; ?>"><?php echo $params['names'][$i]; ?></a>
                        </li>
                        <li>/</li>
                    <?php }else{ ?>
                        <li><?php echo $params['names'][$i]; ?></li>
                    <?php } ?>

        <?php $i++; }?>
    </ul>
</div>
