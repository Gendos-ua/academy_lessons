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
<div class="container">
    <main class="row">
        <div class="col-md-6 offset-md-3" style="text-align: center">
            <h1>Вход</h1>
            <form action="" method="post">
                <div class="form-group">
                    <input name="login" type="text"
                           class="form-control"
                           placeholder="Логин">
                </div>
                <div class="form-group">
                    <input name="password" type="password"
                           class="form-control"
                           placeholder="Пароль">
                </div>
                <button type="submit" class="btn btn-primary">Войти</button>
            </form>
        </div>
    </main>
</div>

