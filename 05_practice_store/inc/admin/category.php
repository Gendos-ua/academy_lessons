<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 10/16/17
 * Time: 19:58
 */


if (isset($_POST['save'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $data = [];

    if (strlen($title)) {
       $data['title'] = $title;
    }

    if (!empty($data)) {
        if ($id > 0) {
            $result = updateCategory($id, $data);
        } else {
            $result = createCategory($data);
        }
    }
}

$id = $_GET['id'];
$categoryResult = categoryList();

?>
<div>
    <a href="?page=category&id=0">Добавить категорию</a>
    <?php if (isset($id)) {

        $title = '';
        if ($id > 0) {
            $category = mysqli_fetch_assoc(categoryList($id));
            $title = $category['title'];
        }

        ?>
        <form action="?page=category" method="post">
            <input type="hidden" name="id" value="<?=$id?>">
            <input type="text" value="<?=$title?>"
                   placeholder="Название категории" name="title">
            <input type="submit" name="save" value="Сохранить">
        </form>
    <? } ?>
    <ul>
    <?php

    while ($category = mysqli_fetch_assoc($categoryResult)) {
        ?>
        <li>
            <a href="?page=category&id=<?=$category['id']?>">
                <?=$category['id']?>: <?=$category['title']?>
            </a>
        </li>
        <?
    }
    ?>
    </ul>
</div>