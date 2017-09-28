<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 9/27/17
 * Time: 21:01
 */

/**
 * Тут должна быть проверка логина и пароля
 * если они правильные, то нужно поставить $_SESSION['auth'] = true;
 * затем обновить страницу.
 */


?>
<main class="row" style="margin-top: 60px;">
    <div class="col-md-12">
        <form action="auth.php" method="post">
            <input name="login" type="text" placeholder="Логин">
            <input name="password" type="password" placeholder="Пароль">
            <button>Войти</button>
        </form>
    </div>
</main>

