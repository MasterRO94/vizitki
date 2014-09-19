<?php defined('VIZITKI') or die('Access denied'); ?>

<section class="registration">
    <h3>Регистрация</h3>

    <form action="" method="post" id="form_register">

        <div class="row">
            <label for="register_fio">ФИО: </label>
            <div class="field">
                <input type="text" name="register_fio" id="register_fio" placeholder="Введите ваше имя, фамилию, отчество" />
            </div>
        </div>

        <div class="row">
            <label for="register_phone">Телефон: </label>
            <div class="field">
                <input type="text" name="register_phone" id="register_phone" placeholder="Введите свой телефон" />
            </div>
        </div>

        <div class="row">
            <label for="register_email">E-Mail: </label>
            <div class="field">
                <input type="email" name="register_email" id="register_email" placeholder="Введите свой email" />
            </div>
        </div>

        <div class="row">
            <label for="register_address">Адрес доставки: </label>
            <div class="field">
                <input type="text" name="register_address" id="register_fio" placeholder="Введите ваш адрес доставки" />
            </div>
        </div>

        <div class="row">
            <label for="register_login">Логин: </label>
            <div class="field">
                <input type="text" name="register_login" id="register_login" placeholder="Введите свой логин для авторизации на сайте" />
            </div>
        </div>

        <div class="row">
            <label for="register_password">Пароль: </label>
            <div class="field">
                <input type="password" name="register_password" id="register_password" placeholder="Введите свой пароль для авторизации на сайте" />
            </div>
        </div>

        <div class="row">
            <input type="submit" name="register_submit" id="register_submit" value="ЗАРЕГЕСТРИРОВАТЬСЯ"/>
        </div>

    </form>

</section>