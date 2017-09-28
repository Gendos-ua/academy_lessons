<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 9/27/17
 * Time: 19:50
 */
?>
<header class="row">
    <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse fixed-top">
        <a class="navbar-brand" href="index.php"><?= $config['company'] ?></a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <?php foreach ($config['menu'] as $item): ?>
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?page=<?= $item['id'] ?>">
                        <?= $item['title'] ?>
                    </a>
                </li>
                <?php endforeach; ?>
                <li class="nav-item active">
                    <span class="nav-link">{{basket}}</span>
                </li>
            </ul>
        </div>
    </nav>
</header>
