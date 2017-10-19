<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 10/18/17
 * Time: 18:46
 */

//header('Content-type: text/plain;');
ini_set('display_errors', 1);

echo '<pre>';


class Human
{

    /** @var int */
    private $age;

    /** @var  string */
    private $name;

    /**
     * @return int
     */
    public function howOld($formatted = false)
    {
        if ($formatted) {
            return "Мне {$this->age} лет";
        }
        return $this->age;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $age
     * @return void|bool
     */
    public function setAge($age)
    {
        if ($age < 18) {
            echo 'Вы слишком молоды'.PHP_EOL;
            return false;
        }

        $this->age = $age;
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }




    private function doubleAge()
    {
        if ($this->age > 0) {
            echo 'Через 20 лет мне будет '
                .($this->age+20)
                .PHP_EOL;
        }
    }
    public function showName()
    {
        echo "My name is {$this->name}".PHP_EOL;
        $this->doubleAge();
        return;
    }
}


$human1 = new Human;
$human1->setName('Bill');
$human1->setAge(20);

$human2 = new Human;
$human2->setName('Antony');
$human2->setAge(32);
//echo $human2->getAge(true);
/*
$human1->showName();
echo PHP_EOL;
$human2->showName();
echo PHP_EOL;


$human3 = $human2;
$human3->setName('Jack');

$human2->showName();

$human4 = clone $human2;
$human4->setName('Stas');

$human2->showName();
$human4->showName();

$human5 = serialize($human2);

/** @var Human $human5 */
/*
$human5 = unserialize($human5);
$human5->setName('Name1');
$human5->showName();

$human2->showName();

*/


class Car
{
    protected $price;
    protected $color;
    protected $brand;

    protected $isDriving = false;

    function __construct($brand, $color, $price) {

        $this->color = $color;
        $this->brand = $brand;
        $this->price = $price;

        echo 'New car!'.PHP_EOL;
    }


    public function drive()
    {
        $this->isDriving = true;
        return $this->isDriving;
    }

    private function __clone()
    {

    }

    function __destruct()
    {
        echo 'Destructed!'.PHP_EOL;
    }


}


$car = new Car('Volvo', 'Red', 15000);
//$car = null;
//var_dump($car);


class Truck extends Car
{
    public $className = 'Truck';

    private $weight;
    protected $brand;

    public function setWeight($value)
    {
        $this->weight = $value;
    }

    public function __construct($brand, $color, $price, $weight)
    {
        $brand .= ' Truck';
        parent::__construct($brand, $color, $price);
        $this->setWeight($weight);
    }


    public function drive()
    {
        return parent::drive();
    }

    public function displayParams()
    {
        echo "Brand: {$this->brand}";
    }

}


$truck = new Truck('Mercedes', 'Black', 50000, 20000);
var_dump($truck->drive());
var_dump($truck);

$field = 'className';
echo $truck->{"$field"}.PHP_EOL;

$truck->displayParams();


