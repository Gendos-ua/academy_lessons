<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/13/17
 * Time: 20:34
 */

namespace App\Entity;


abstract class Base
{

    /** @var \App\Core\DB\IConnection */
    protected $conn;


    abstract function getTableName();

    abstract function checkFields($data);

    abstract function getFields();


    /**
     * Base constructor.
     * @param \App\Core\DB\IConnection $connection
     */
    public function __construct(\App\Core\DB\IConnection $connection)
    {
        $this->conn = $connection;
    }

    /**
     * @param array $filter
     * @return mixed
     */
    public function list($filter = [])
    {
        $fields = $this->getFields();
        $where = [];
        $strWhere = '';
        foreach ($filter as $fieldName => $value) {
            if (!in_array($fieldName, $fields)) {
                continue;
            }

            //$fieldName = $this->conn->escape($fieldName);
            $value = $this->conn->escape($value);
            $where[] = "$fieldName = $value";
        }

        if (!empty($where)) {
            $strWhere = ' AND '.implode(' AND ', $where);
        }


        $sql = 'SELECT * FROM '.$this->getTableName().' WHERE 1 '.$strWhere;

        return $this->conn->query($sql);
    }
//SELECT * FROM pages WHERE 1  AND 'active' = 1

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        $sql = 'SELECT * FROM '.$this->getTableName().' WHERE id = '.$this->conn->escape($id).' LIMIT 1';
        $result = $this->conn->query($sql);

        return isset($result[0]) ? $result[0] : null;
    }


    /**
     * @param $data
     * @param null $id
     * @return mixed
     */
    public function save($data, $id = null)
    {
        $this->checkFields($data);

        $fields = $this->getFields();

        $values = [];
        foreach ($data as $key => $val) {
            if (!in_array($key, $fields)) {
                unset($data[$key]);
                continue;
            }

            $this->conn->escape($val);
            if ($id > 0) {
                $values[] = "$key = ?";
            } else {
                $values[] = $val;
            }
        }

        $cols = implode(',', array_keys($data));

        if ($id > 0) {
            $values = implode(',', $values);
            $data[] = $id;
            $sql = "UPDATE ".$this->getTableName()." SET $values WHERE id = ?";
        } else {
            $vals = rtrim(str_repeat('?,', count($data)), ',');
            $sql = "INSERT INTO ".$this->getTableName()." ($cols) VALUES ($vals)";
        }

        return $this->conn->query($sql, array_values($data));
    }


    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $id = intval($id);

        $sql = 'DELETE FROM '.$this->getTableName()
            .' WHERE id = '.$this->conn->escape($id);
        return $this->conn->query($sql);
    }

}