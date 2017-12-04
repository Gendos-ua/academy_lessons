<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 12/4/17
 * Time: 17:43
 */


/**
 * Абстрактная фабрика (Abstract Factory)
 *
 * Создать ряд связанных или зависимых объектов без указания их конкретных классов.
 * Обычно создаваемые классы стремятся реализовать один и тот же интерфейс.
 * Клиент абстрактной фабрики не заботится о том, как создаются эти объекты,
 * он просто знает, по каким признакам они взаимосвязаны и как с ними обращаться.
 */


# ПРОБЛЕМА

abstract class Footman
{
    public function attack($target)
    {
        return 'Footman attacking '.$target;
    }
}

class AlienFootman extends Footman {}
class ZombieFootman extends Footman {}



abstract class Transport
{
    public function attack($target)
    {
        return 'Transport attacking '.$target;
    }
}

class AlienTransport extends Transport { }
class ZombieTransport extends Transport { }

$footman_1 = new AlienFootman();
$footman_2 = new ZombieFootman();
// и так для каждого юнита
$footman_1->attack($footman_2);









# РЕШЕНИЕ

abstract class MonsterFactory
{
    abstract public function createFootman();

    abstract public function createTransport();
}

class AlienFactory extends MonsterFactory
{
    public function createFootman()
    {
        return new AlienFootman();
    }

    public function createTransport()
    {
        return new AlienTransport();
    }
}

class ZombieFactory extends MonsterFactory
{
    public function createFootman()
    {
        return new ZombieFootman();
    }

    public function createTransport()
    {
        return new ZombieTransport();
    }
}

$zombies = new ZombieFactory();
$aliens = new AlienFactory();

// Так как оба пехотинца имеют общий интерфейс, то нам неважно какому классу они принадлежат.
$zFootman = $zombies->createFootman();
$aFootman = $aliens->createFootman();
$zTransport = $zombies->createTransport();

$aFootman->attack($zFootman);
$zTransport->attack($aFootman);

