<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 10/16/17
 * Time: 20:02
 */



$dbHost = 'localhost';
$dbUser = 'goods';
$dbPassword = 'goods';
$dbName = 'goods';

$connection = mysqli_connect(
    $dbHost,
    $dbUser,
    $dbPassword,
    $dbName
);

$tablesMap = [
    'category' => 'category',
    'product' => 'product',
];


/** Get entity */

/**
 * @param null $id
 * @return bool|mysqli_result
 */
function categoryList($id = null)
{
    return getList($GLOBALS['tablesMap']['category'], $id);
}


/**
 * @param null $id
 * @return bool|mysqli_result
 */
function productList($id = null)
{
    return getList($GLOBALS['tablesMap']['product'], $id);
}

/**
 * @param $tableName
 * @param null $id
 * @return bool|mysqli_result
 */
function getList($tableName, $id = null)
{
    global $connection;


    $where = '';

    if ($id > 0) {
        $where = ' WHERE id = '.$id;
    }

    $result = mysqli_query(
        $connection,
        "SELECT * FROM $tableName $where;"
    );

    return $result;
}




/** Create entity */

/**
 * @param $fields
 * @return bool|mysqli_result
 */
function createCategory($fields)
{
    return createEntity(
        $GLOBALS['tablesMap']['category'],
        $fields
    );
}

/**
 * @param $tableName
 * @param $data
 * @return bool|mysqli_result
 */
function createEntity($tableName, $data)
{
    global $connection;

    foreach ($data as &$val) {
        $val = mysqli_escape_string($connection, $val);
    }

    $cols = implode(',', array_keys($data));
    $values = "'".implode("','", $data)."'";
    return mysqli_query(
        $connection,
        "INSERT INTO $tableName ($cols) VALUES ($values)"
    );
}

/** Update entity */

/**
 * @param $id
 * @param $data
 * @return bool|mysqli_result
 */
function updateCategory($id, $data)
{
    return updateEntity(
        $GLOBALS['tablesMap']['category'],
        $id,
        $data
    );
}


/**
 * @param $tableName
 * @param $id
 * @param $data
 * @return bool|mysqli_result
 */
function updateEntity($tableName, $id, $data)
{
    global $connection;

    $values = [];

    foreach ($data as $key => $val) {
        $val = mysqli_escape_string($connection, $val);
        $values[] = "$key = '$val'";
    }

    $values = implode(',', $values);

    return mysqli_query(
        $connection,
        "UPDATE $tableName SET $values WHERE id = $id;"
    );
}
