<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 07.12.2018
 * Time: 12:55
 */

/**
 * Получение html кода футера
 */
?>

<html>
    <head>
        <base href="/i-market/">
        <?php Common::getScripts("Head"); ?>
    </head>
    <body>
        <div id="content">
            <header>
                <div class="container-fluid header">
                    <div class="container " >
                        <div class="row">
                            <h1>Header</h1>
                        </div>
                        <nav class="row">
                            <div class="col-lg-3 col-sm-12">
                                <a href="/i-market/">LOGO</a>
                            </div>
                            <div class="col-lg-9 col-sm-12">
                                <ul id="main-menu">
                                    <?php  if(UserModel::isGuest()){?>
                                        <li><a href="cabinet">Кабинет</a></li>
                                        <li><a href="user/logout">Выход</a></li>
                                    <?php }else{?>
                                        <li><a href="user/register">Регистрация</a></li>
                                        <li><a href="user/login">Вход</a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </header>
