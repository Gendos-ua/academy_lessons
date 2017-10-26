<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 10/25/17
 * Time: 15:38
 */

interface IDrawable
{
    public function draw($color);
}

abstract class Figure// implements IDrawable
{
    protected $name = '';

    public function getName()
    {
        return $this->name;
    }

    public static function getVersion()
    {
        return '1.0.0';
    }

    abstract public function draw($color);
}


final class Rectangle extends Figure
{
    const VERSION = 1;
    public $name = 'Прямоугольник';

    protected $width;
    protected $height;

    final public function draw($color)
    {
        // рисуем
    }

    public function setDimentions($width, $height)
    {
        $this->height = $height;
        $this->width = $width;
    }

    public function setWidth($width)
    {
        $this->width = $width;
    }

    public function setHeight($height)
    {
        $this->height = $height;
    }
}

class Circle extends Figure
{
    protected $name = 'Круг';

    public function draw($color)
    {
        // рисуем
    }
}

class Square extends Figure
{
    protected $name = 'Квадрат';
    protected $length;

    public function draw($color)
    {
        // рисуем
    }

    public function setLenght($length)
    {
        $this->length = $length;
    }

    public function describe()
    {
        foreach ($this as $k => $v) {
            echo "$k => $v <br>";
        }
    }
}

$square = new Square();
$square->setLenght(10);
$square->describe();