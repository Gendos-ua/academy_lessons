<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/13/17
 * Time: 19:07
 */


function __($code, $default = '')
{
    return \App\Core\Localization::get($code, $default);
}

function pre($data)
{
    echo '<pre>', print_r($data, 1), '</pre>';
}