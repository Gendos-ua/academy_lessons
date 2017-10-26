Задание выполняем на основе решения предыдущего ДЗ по магазину - https://github.com/Gendos-ua/academy_lessons/tree/master/05_practice_store

1. Создать базовый абстрактный класс `Entity` для CRUD операций над сущностями в таблице. 

   В нем реализовать методы для - получения списка элементов таблицы, добавления новых, обновления существующих и удаления.
   Имя таблицы получаем из метода `getTableName`, его делаем абстрактым.
   Пример (без реализации методов):
   ```
    
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
    ```
    Для каждой сущности в нашей базе данных создать наследника класса `Entity` и реализовать в каждом все абстрактные методы. Каждый класс пишем в отдельном одноименном файле.
    
