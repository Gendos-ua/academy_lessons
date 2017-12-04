<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 12/4/17
 * Time: 11:41
 */

/**
 * Простая фабрика (Simple Factory)
 *
 */


class Bicycle
{
    public function driveTo(string $destination)
    {

    }
}




class SimpleFactory
{

    public function createBicycle(): Bicycle
    {
        return new Bicycle();
    }
}



$factory = new SimpleFactory();
$bicycle = $factory->createBicycle();
$bicycle->driveTo('Paris');