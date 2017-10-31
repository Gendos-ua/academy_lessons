<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 10/23/17
 * Time: 17:36
 */

/**
 * I - принцип разделения интерфейса
 * Interface Segregation
 *
 * Клиенты(классы) не должны зависеть от методов, которые они не используют.
 * Много специализирвоанных интерфейсов - лучше, чем один универсальный.
 */


// ---- ПОЛОХО ----

interface ISuperTransformer
{
    public function toCar();

    public function toPlane();

    public function toShip();
}



class SuperTransformer implements ISuperTransformer
{

    public function toCar()
    {
        echo 'transformed to Car';
    }

    public function toPlane()
    {
        echo 'transformed to Plane';
    }

    public function toShip()
    {
        echo 'transformed to Ship';
    }
}


class CarTransformer implements ISuperTransformer
{

    public function toCar()
    {
        echo 'transformed to Car';
    }

    public function toPlane()
    {
        throw new Exception('Cant tranform to Plane');
    }

    public function toShip()
    {
        throw new Exception('Cant tranform to Ship');
    }
}


// ---- ХОРОШО ----

interface ICarTransformer
{
    public function toCar();
}

interface IPlaneTransformer
{
    public function toPlane();
}

interface IShipTransformer
{
    public function toShip();
}

class CarTransformerGood implements ICarTransformer
{
    public function toCar()
    {
        // TODO: Implement toCar() method.
    }
}


class SuperTransformerGood implements
    ICarTransformer, IPlaneTransformer, IShipTransformer
{

    public function toCar()
    {
        echo 'transformed to Car';
    }

    public function toPlane()
    {
        echo 'transformed to Plane';
    }

    public function toShip()
    {
        echo 'transformed to Ship';
    }
}