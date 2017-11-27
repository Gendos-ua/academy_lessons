<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/27/17
 * Time: 18:20
 */

# Telescoping Constructor

class NutritionFacts {

    private $servingSize;   // обязательный параметр
    private $servings;   // обязательный параметр
    private $calories;   // дополнительный параметр
    private $fat;       // дополнительный параметр
    private $sodium;     // дополнительный параметр
    private $carbohydrate; // дополнительный параметр

    public function __construct(
        $servingSize,
        $servings,
        $calories = null,
        $fat = null,
        $sodium = null,
        $carbohydrate = null
    )
    {
        $this->servingSize = $servingSize;
        $this->servings = $servings;
        $this->calories = $calories;
        $this->fat = $fat;
        $this->sodium = $sodium;
        $this->carbohydrate = $carbohydrate;
    }
}

$cocaCola = new NutritionFacts(240, 8, 100, 0, 35, 27);



# JavaBeans
class NutritionFactsJavaBeans {

    private $servingSize = -1;   // обязательный параметр
    private $servings = -1;   // обязательный параметр
    private $calories = 0;   // дополнительный параметр
    private $fat = 0;       // дополнительный параметр
    private $sodium = 0;     // дополнительный параметр
    private $carbohydrate = 0;  // дополнительный параметр

    /**
     * @param int $servingSize
     */
    public function setServingSize(int $servingSize)
    {
        $this->servingSize = $servingSize;
    }

    /**
     * @param int $servings
     */
    public function setServings(int $servings)
    {
        $this->servings = $servings;
    }

    /**
     * @param int $calories
     */
    public function setCalories(int $calories)
    {
        $this->calories = $calories;
    }

    /**
     * @param int $fat
     */
    public function setFat(int $fat)
    {
        $this->fat = $fat;
    }

    /**
     * @param int $sodium
     */
    public function setSodium(int $sodium)
    {
        $this->sodium = $sodium;
    }

    /**
     * @param int $carbohydrate
     */
    public function setCarbohydrate(int $carbohydrate)
    {
        $this->carbohydrate = $carbohydrate;
    }

    public function __construct()
    {

    }
}

$cocaCola = new NutritionFactsJavaBeans();
$cocaCola->setServingSize(240);
$cocaCola->setServings(8);
$cocaCola->setCalories(100);
$cocaCola->setSodium(35);
$cocaCola->setCarbohydrate(27);



# Builder


class NutritionFactsObject
{
    private $servingSize = -1;   // обязательный параметр
    private $servings = -1;   // обязательный параметр
    private $calories = 0;   // дополнительный параметр
    private $fat = 0;       // дополнительный параметр
    private $sodium = 0;     // дополнительный параметр
    private $carbohydrate = 0;  // дополнительный параметр

    public function __construct(NutritionFactsBuilder $builder)
    {
        $this->servingSize = $builder->getServingSize();
        $this->servings = $builder->getServings();
        $this->calories = $builder->getCalories();
        $this->fat = $builder->getFat();
        $this->sodium = $builder->getSodium();
        $this->carbohydrate = $builder->getCarbohydrate();
    }
}


class NutritionFactsBuilder
{
    private $servingSize = -1;   // обязательный параметр
    private $servings = -1;   // обязательный параметр
    private $calories = 0;  // дополнительный параметр
    private $fat = 0;       // дополнительный параметр
    private $sodium = 0;     // дополнительный параметр
    private $carbohydrate = 0;

    /**
     * @return int
     */
    public function getServingSize(): int
    {
        return $this->servingSize;
    }

    /**
     * @return int
     */
    public function getServings(): int
    {
        return $this->servings;
    }

    /**
     * @return int
     */
    public function getCalories(): int
    {
        return $this->calories;
    }

    /**
     * @return int
     */
    public function getFat(): int
    {
        return $this->fat;
    }

    /**
     * @return int
     */
    public function getSodium(): int
    {
        return $this->sodium;
    }

    /**
     * @return int
     */
    public function getCarbohydrate(): int
    {
        return $this->carbohydrate;
    }  // дополнительный параметр


    /**
     * @param int $calories
     */
    public function setCalories(int $calories)
    {
        $this->calories = $calories;
        return $this;
    }

    /**
     * @param int $fat
     */
    public function setFat(int $fat)
    {
        $this->fat = $fat;
        return $this;
    }

    /**
     * @param int $sodium
     */
    public function setSodium(int $sodium)
    {
        $this->sodium = $sodium;
        return $this;
    }

    /**
     * @param int $carbohydrate
     */
    public function setCarbohydrate(int $carbohydrate)
    {
        $this->carbohydrate = $carbohydrate;
        return $this;
    }

    public function __construct($servingSize, $servings) {
        $this->servingSize = $servingSize;
        $this->servings = $servings;
    }

    public function build()
    {
        return new NutritionFactsObject($this);
    }
}


$bilder = new NutritionFactsBuilder(120, 32);
$bilder->setSodium(5)->setCarbohydrate(10);
$cocaCola = $bilder->build();
