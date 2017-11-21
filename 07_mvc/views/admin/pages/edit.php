<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/20/17
 * Time: 19:56
 */

$isNew = empty($data) || isset($data['new']);

?>

<div class="col-lg-12">
    <h1><?=($isNew ? 'Create' : 'Edit')?> Page</h1>
</div>
<div class="col-lg-12">
    <form method="post" action="">
        <div class="form-group">
            <input class="form-control" name="title" value="<?=(isset($data['title']) ? $data['title'] : '')?>">
        </div>
        <div class="form-group">
            <textarea rows="15" class="form-control" name="content"><?=(isset($data['content']) ? $data['content'] : '')?></textarea>
        </div>
        <div class="form-group">
            <label for="active">Publish page</label>
            <input type="checkbox" value="1" name="active"
                <?=($isNew || $data['active'] ? 'checked' : '')?>>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>

