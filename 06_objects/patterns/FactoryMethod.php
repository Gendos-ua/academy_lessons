<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 12/4/17
 * Time: 11:35
 */

/**
 * Фабричный метод (Factory Method)
 * Определяет интерфейс для создания объекта, но оставляет подклассам решение о том, какой классинстанциировать.
 * Фабричный метод позволяет классу делегировать создание подклассов. Используется, когда:
 *
 * * классу заранее неизвестно, объекты каких подклассов ему нужно создавать.
 *
 * * класс спроектирован так, чтобы объекты, которые он создаёт, специфицировались подклассами.
 *
 * * класс делегирует свои обязанности одному из нескольких вспомогательных подклассов,
 *   и планируетсялокализовать знание о том, какой класс принимает эти обязанности на себя.
 */

# ПРОБЛЕМА:

abstract class Product
{
    private   $sku;
    private   $name;
    protected $type = null;

    public function __construct($sku, $name)
    {
        $this->sku  = $sku;
        $this->name = $name;
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getType()
    {
        return $this->type;
    }
}

class ProductChair extends Product
{
    protected $type = 'chair';
}

class ProductTable extends Product
{
    protected $type = 'table';
}

class ProductBookcase extends Product
{
    protected $type = 'bookcase';
}

class ProductSofa extends Product
{
    protected $type = 'sofa';
}

$product1 = new ProductChair('0001','INGOLF Chair');
$product2 = new ProductTable('0002','STOCKHOLN Table');


class BadProductController
{
    public function create($productType)
    {
        // Логика валидации продукта

        $post = $_POST;
        // Здесь нам нужно создать нужный продукт
        switch($productType)
        {
            case 'chair':
                $product = new ProductChair($post['sku'], $post['name']);
                break;

            case 'table':
                $product = new ProductTable($post['sku'], $post['name']);
                break;

            case 'sofa':
                $product = new ProductSofa($post['sku'], $post['name']);
                break;

            case 'bookcase':
                $product = new ProductBookcase($post['sku'], $post['name']);
                break;
        }

        // Что-то делаем с продуктом и сохраняем

        // ...

        return $product->getType();
    }
}



# РЕШЕНИЕ

class ProductFactory
{
    public static function build($productType,  $sku, $name)
    {
        $product = "Product" . ucfirst($productType);

        if (class_exists($product)) {
            return new $product($sku, $name);
        } else {
            throw new \Exception("Неверный тип продукта");
        }
    }
}

class GoodProductController
{
    public function create($productType)
    {
        // Валидация продукта

        $post = $_POST;

        // Здесь создаём продукт с помощью Фабричного метода
        $product = ProductFactory::build($productType, $post['sku'], $post['name']);

        // Что-то делаем с продуктом и сохраняем

        // ...

        return $product->getType();
    }
}

