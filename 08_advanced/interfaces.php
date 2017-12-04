<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 12/4/17
 * Time: 19:53
 */

class Pimple implements ArrayAccess
{
    private $container = [];

    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    public function offsetGet($offset)
    {
        if (is_callable($this->container[$offset])) {
            return $this->container[$offset]($this);
        }

        return $this->container[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->container[$offset] = $value;
    }

    public function one($offset, callable $value)
    {
        $this->container[$offset] = function ($container) use ($value) {
            static $result = null;
            if (!$result) {
                $result = $value($container);
            }
            return $result;
        };
    }

    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }
}


$p = new Pimple();

$p['one'] = function () {
    return rand(10, 30);
};

echo '<PRE>';

echo $p['one'].PHP_EOL;
echo $p['one'].PHP_EOL;




class User
{
    protected $session;
    public function __construct(ISession $session) {
        $this->session = $session;
    }
}

interface ISession
{
    // methods
}

class Session implements ISession
{
    public function __construct($sessionName) {
        session_name($sessionName);
        session_start();
    }
}


$pimple = new Pimple();

$pimple['SESSION_NAME'] = 'SESSID';
$pimple['session'] = function ($container) {
    echo 'Get session'.PHP_EOL;
    return new Session($container['SESSION_NAME']);
};
$pimple->one('user', function ($container) {
    echo 'Get user'.PHP_EOL;
    return new User($container['session']);
});


echo 'PimpleStart:'.PHP_EOL;

$user = $pimple['session'];
$user = $pimple['session'];
$user = $pimple['user'];
$user = $pimple['user'];
$user = $pimple['user'];


