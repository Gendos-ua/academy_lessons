<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 10/23/17
 * Time: 17:36
 */


/**
 * O - Принцип открытости / закрытости
 * Open / Closed
 *
 * Классы должны быть открыты для расширения и закрыты для изменения.
 *
 * Приложение следует проектировать таким образом, чтобы для изменения поведения класса
 * нам не потребовалось менять код самого класса
 */


// ---- ПЛОХО ----


interface ILogger
{
    public function logException(Exception $e);
}

class DbLogger implements ILogger
{
    protected function writeToDb($text)
    {
        // пишем в файл
    }


    public function logException(Exception $e)
    {
        $this->writeToDb($e->getMessage());
    }
}


class FileLogger implements ILogger
{
    protected function writeToFile($text)
    {
        // пишем в файл
    }


    public function logException(Exception $e)
    {
        $this->writeToFile($e->getMessage());
    }
}


class Product
{
    protected $logger;

    public function __construct(ILogger $logger)
    {
        $this->logger = $logger;
    }

    public function setPrice($price)
    {
        try {
            // пытаемся обновить цену
        } catch (DBException $e) {
            // ловим исключение
            $this->logger->logException($e);
        }
    }
}

$logger = new FileLogger();
$product = new Product($logger);
$product->setPrice(10);
