<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/13/17
 * Time: 20:40
 */

namespace App\Core\DB;

interface IConnection
{
    public function __construct($host, $user, $pass, $dbName);

    public function query($sql, $data = []);

    public function escape($data);
}