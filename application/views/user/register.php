<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 14.12.2018
 * Time: 16:02
 */


require (ROOT.'/application/views/components/header.php'); ?>

<main>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <h2>Регистрация на сайте</h2>
                <?php if(isset($result)){?>
                    <p>Вы зарегестрированы!</p>
                <?php }else{ ?>
                <?php if(isset($errors)&&is_array($errors)){?>
                    <ul>
                        <?php foreach ($errors as $error){ ?>
                            <li>-<?php echo $error; ?></li>
                        <?php } ?>
                    </ul>
                <?php } ?>
                <form action="user/register" method="post">
                    <input type="text" name="login" placeholder="login" value="<?php echo $login;?>">
                    <input type="email" name="email" placeholder="email" value="<?php echo $email;?>">
                    <input type="password" name="password" placeholder="password" value="<?php echo $password;?>">
                    <input type="submit" name="submit" value="Отправить" class="btn btn-default" placeholder="">
                </form>
                <?php } ?>
            </div>
        </div>
    </div>


</main>
<?php require (ROOT.'/application/views/components/footer.php'); ?>