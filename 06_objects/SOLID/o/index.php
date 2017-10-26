<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 10/23/17
 * Time: 17:36
 */


/**
 * O - Принцип открытости / закрытости
 * Open / Closed
 *
 * Классы должны быть открыты для расширения и закрыты для изменения.
 *
 * Приложение следует проектировать таким образом, чтобы для изменения поведения класса
 * нам не потребовалось менять код самого класса
 */


// ---- ПЛОХО ----


interface ILogger
{
    public function logException(Exception $e);
}

class DbLogger implements ILogger
{
    protected function writeToDb($text)
    {
        // пишем в файл
    }


    public function logException(Exception $e)
    {
        $this->writeToDb($e->getMessage());
    }
}


class FileLogger implements ILogger
{
    protected function writeToFile($text)
    {
        // пишем в файл
    }


    public function logException(Exception $e)
    {
        $this->writeToFile($e->getMessage());
    }
}


class Product
{
    protected $logger;

    public function __construct(ILogger $logger)
    {
        $this->logger = $logger;
    }

    public function setPrice($price)
    {
        try {
            // пытаемся обновить цену
        } catch (DBException $e) {
            // ловим исключение
            $this->logger->logException($e);
        }
    }
}

$logger = new FileLogger();
$product = new Product($logger);
$product->setPrice(10);



abstract class Entity
{
    /**
     * @return string
     */
    abstract public function getTableName(): string;

    /**
     * Метод должен вовращать поля текущей таблицы (кроме id)
     * в формате:
     * [
     *      'fieldName' => 'fieldType',
     *      'fieldName2' => 'fieldType',
     *      ...
     * ]
     *
     * @return array
     */
    abstract public function getMap(): array;


    /**
     * Этот метод вызываем перед каждым обновлением/добавлением,
     * здесь проверяем каждый элемент массива на соответствие типу из массива
     * полученного в getMap, если тип не соответствует - выбрасываем исключение.
     *
     * @param array $data
     * @return bool
     * @throws Exception
     */
    abstract protected function checkFields(array $data): bool;

    /**
     * В этом методе получаем список элементов таблицы
     * полученной из метода getTableName
     *
     * @param int|null $id
     */
    public function get(int $id = null) { /* Тут реализация */ }


    /**
     * В этом методе создаем новую запись в таблице getTableName.
     * Перед созданием проверяем корректность данных вызовом метода checkFields.
     *
     * @param array $data
     */
    public function create(array $data) { /* Тут реализация */ }

    /**
     * В этом методе обновляем запись в таблице getTableName.
     * Перед обновлением проверяем корректность данных вызовом метода checkFields.
     *
     * @param int $id
     * @param array $data
     */
    public function update(int $id, array $data) { /* Тут реализация */ }

    /**
     * В этом методе удаляем запись в таблице getTableName по id.
     *
     * @param int $id
     */
    public function delete(int $id) { /* Тут реализация */ }
}