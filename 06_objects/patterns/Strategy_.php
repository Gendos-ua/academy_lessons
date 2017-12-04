<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 12/4/17
 * Time: 13:05
 */


/**
 * Стратегия (Strategy)
 *
 */


class Book
{
    private $author;
    private $title;

    function __construct($title_in, $author_in)
    {
        $this->author = $author_in;
        $this->title  = $title_in;
    }
    function getAuthor()
    {
        return $this->author;
    }
    function getTitle()
    {
        return $this->title;
    }
    function getAuthorAndTitle()
    {
        return $this->getTitle() . ' by ' . $this->getAuthor();
    }
}


interface StrategyInterface
{
    public function showTitle(Book $book);
}

class StrategyCaps implements StrategyInterface
{
    public function showTitle(Book $book) {
        $title = $book->getTitle();
        return strtoupper($title);
    }
}

class StrategyExclaim implements StrategyInterface
{
    public function showTitle(Book $book)
    {
        $title = $book->getTitle();
        return str_replace(' ','!',$title);
    }
}

class StrategyStars implements StrategyInterface
{
    public function showTitle(Book $book)
    {
        $title = $book->getTitle();
        return str_replace(' ','*',$title);
    }
}




class StrategyContext
{
    private $strategy = NULL;

    public function __construct($strategy_ind_id)
    {
        $strategyName = "Strategy".ucfirst($strategy_ind_id);
        $this->strategy = new $strategyName();
    }

    public function showBookTitle(Book $book)
    {
        return $this->strategy->showTitle($book);
    }
}



$book = new Book('PHP for Cats','Larry Truett');

$strategyContextC = new StrategyContext('Caps');
$strategyContextE = new StrategyContext('Exclaim');
$strategyContextS = new StrategyContext('Stars');

echo '<PRE>';

echo $strategyContextC->showBookTitle($book).PHP_EOL;
echo $strategyContextE->showBookTitle($book).PHP_EOL;
echo $strategyContextS->showBookTitle($book).PHP_EOL;