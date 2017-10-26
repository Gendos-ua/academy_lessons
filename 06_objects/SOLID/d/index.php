<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 10/23/17
 * Time: 17:36
 */

/**
 * D - принцип инверсии зависимостей
 * Dependency Inversion
 *
 * Сложно:
 * Зависимости внутри системы строятся вокруг абстракций,
 * модули верхних уровней не должны зависеть от модулей нижних уровней,
 * оба типа модулей должны зависеть от абстракций.
 * Абстракции не должны зависеть от деталей - детали должны зависеть от абстракций.
 *
 *
 * Просто:
 * Зависимости должны строиться относительно абстракций(интерфейсов), а не деталей(классов).
 */


// ---- ПЛОХО ----

class Wife
{
    public function getFood()
    {
        return 'еда';
    }
}


class lowRankingMale
{

    public function eat()
    {
        $wife = new Wife();
        $food = $wife->getFood();
        // кушаем еду
    }

}


class averageRankingMale
{
    protected $wife;

    public function __construct(Wife $wife)
    {
        $this->wife = $wife;
    }

    public function eat(Wife $wife)
    {
        $food = $this->wife->getFood();
        // кушаем еду
    }
}




// ---- ХОРОШО ----



class highRankingMale
{
    private $provider;

    public function __construct(IFoodProvider $foodProvider)
    {
        $this->provider = $foodProvider;
    }

    public function eat()
    {
        $food = $this->provider->getFood();
        // кушаем еду
    }
}

interface IFoodProvider
{
    public function getFood();
}

class Restaurant implements IFoodProvider
{
    public function getFood()
    {
        return 'еда из ресторана';
    }
}