<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/14/17
 * Time: 18:53
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

class MyException extends Exception implements Throwable
{

}

class MyClass
{
    public function __destruct()
    {
        echo 'Закрываю соединение...';
        throw new Exception('Ошибка в '.__CLASS__);
    }
}

class MyNewClass
{
    public function __destruct()
    {
        echo 'Записываю в лог...';
        throw new MyException('Ошибка в '.__CLASS__);
    }
}

try {
    $db = new MyClass();
    $log = new MyNewClass();
    $db = null;
    $log = null;
} catch (Exception $e) {
    echo $e->getMessage();
} catch (MyException $e) {
    echo $e->getMessage();
}