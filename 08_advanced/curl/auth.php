<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 1/15/18
 * Time: 20:57
 */

$secret = '4nfflkn42rnk2l3krn2l3';

if ($_POST) {
    if ($_POST['secret'] === $secret) {
        if ($_POST['login'] == 'admin' && $_POST['password'] == 'password') {
            echo 'Success!';
        } else {
            echo 'Wrong credentials.';
        }
    } else {
        echo 'Wrong secret!';
    }
    die();
}

?>
<!DOCTYPE html>
<html>
<head></head>

<body>

    <form method="post" action="" enctype="multipart/form-data">
        <input type="hidden" value="<?=$secret?>" name="secret">
        <input type="text" name="login" value="">
        <input type="password" name="password" value="">
        <button type="submit">1</button>
    </form>

</body>
</html>
