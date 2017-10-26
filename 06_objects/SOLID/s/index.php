<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 10/23/17
 * Time: 17:36
 */


/**
 * S - Принцип единственной обязанности (ответственности)
 * Single Responsibility
 *
 * Любой объект должен иметь одну обязанность
 * и эта обязанность должна быть полностью реализована в классе объекта.
 */


// ---- ПЛОХО ----

class ProductBad
{
    protected $price;

    public function setPrice($price)
    {
        try {
            // пытаемся обновить цену
        } catch (DBException $e) {
            $this->logException($e);
        }
    }

    protected function logException(Exception $e)
    {
        // запись в файл
    }

}

$product = new ProductBad();
$product->setPrice(10);

// ---- ХОРОШО ----


class Product
{
    protected $price;

    /** @var Logger */
    protected $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function setPrice($price)
    {
        try {
            // пытаемся обновить цену
        } catch (DBException $e) {
            $this->logger->logException($e);
        }
    }
}

class Logger
{
    public function logException(Exception $e)
    {
        $this->writeToFile($e->getMessage());
    }

    protected function writeToFile($message)
    {
        // пишем в файл
    }
}

$logger = new Logger();
$product = new Product($logger);

$product->setPrice(10);