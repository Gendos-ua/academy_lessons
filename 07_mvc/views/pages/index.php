<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/6/17
 * Time: 20:10
 */
?>
<div class="col-lg-12">
    <h1>Welcome to homepage</h1>
</div>

<div class="col-lg-12">
    <ul class="list-group">
        <li class="list-group-item active">Pages List</li>
        <?foreach ($data as $page):?>
            <li class="list-group-item">
                <a href="<?=\App\Core\App::getRouter()->buildUri('view', [$page['id']])?>"><?=$page['title']?></a>
            </li>
        <?endforeach;?>
    </ul>
</div>
