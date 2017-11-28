<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/27/17
 * Time: 19:55
 */


class ArrayTest extends \PHPUnit\Framework\TestCase
{
    public function testEmpty()
    {
        $data = [];
        $this->assertEquals(0, count($data));
    }

    public function testInsertion()
    {
        $data = [];

        array_push($data, 0);

        $this->assertNotEmpty($data);
    }
}