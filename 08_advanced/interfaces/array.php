<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 12/4/17
 * Time: 20:11
 */


class CustomArray implements Iterator, Countable, Serializable
{
    protected $storage = [];

    public function __construct(array $data) {
        $this->storage = $data;
    }

    public function current()
    {
        return current($this->storage);
    }

    public function next()
    {
        return next($this->storage);
    }

    public function key()
    {
        return key($this->storage);
    }

    public function valid()
    {
        return current($this->storage);
    }

    public function rewind()
    {
        return reset($this->storage);
    }

    public function count()
    {
        return count($this->storage);
    }

    public function serialize()
    {
        return serialize($this->storage);
    }

    public function unserialize($serialized)
    {
        return $this->storage = unserialize($serialized);
    }
}


$c = new CustomArray(['one' => '1', 'two' => '2', 'three' => '3']);

echo '<PRE>';

foreach ($c as $key => $value) {
    echo $key.' => '.$value.PHP_EOL;
}


$c->rewind();
while ($c->valid()) {
    echo $c->key().' => '.$c->current().PHP_EOL;
    $c->next();
}


class AnotherArray implements IteratorAggregate
{
    protected $storage = [];

    public function __construct(array $data)
    {
        $this->storage = $data;
    }

    /**
     * Наш метод делает то-то
     *
     *
     *
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->storage);
    }
}


$c = new AnotherArray(['four' => '4', 'five' => '5', 'six' => '6']);

foreach ($c as $key => $value) {
    echo $key.' => '.$value.PHP_EOL;
}
