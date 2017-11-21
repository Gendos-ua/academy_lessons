<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/6/17
 * Time: 20:10
 */

$router = \App\Core\App::getRouter();


?>
<div class="col-lg-12">
    <h1>Pages management</h1>
</div>

<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-12 mb-15">
            <a class="btn btn-success"
               href="<?=$router->buildUri('edit')?>">Create page</a>
        </div>
    </div>

    <ul class="list-group">
        <li class="list-group-item active">Pages List</li>
        <?foreach ($data as $page):?>
            <li class="list-group-item">
                <?=$page['title']?>

                <a class="btn btn-sm btn-success"
                   href="<?=$router->buildUri('edit', [$page['id']])?>">Edit</a>

                <a class="btn btn-sm btn-warning" onclick="return confirmDelete();"
                   href="<?=$router->buildUri('delete', [$page['id']])?>">Delete</a>

            </li>
        <?endforeach;?>
    </ul>
</div>
