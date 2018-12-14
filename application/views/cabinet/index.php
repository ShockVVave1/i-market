<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 14.12.2018
 * Time: 19:29
 */

require (ROOT.'/application/views/components/header.php'); ?>


<main>
    <div class="container">
        <div class="row">
            <section>
                <h1>Кабинет пользователя</h1>
                <h3><?php echo 'Добро пожаловать, '.$user['login']; ?></h3>
                <ul>
                    <li><a href="/i-market/cabinet/edit">Редактировать данные</a></li>
                    <li><a href="/i-market/cabinet/ads">Мои заказы</a></li>
                </ul>
            </section>
        </div>
    </div>
</main>

<?php require (ROOT.'/application/views/components/footer.php'); ?>