/**


mysqldump (bash)
  Делаем бекап
  mysqldump -u USER -pPASSWORD DATABASE > dump.sql

  Создаём структуру базы без данных
  mysqldump --no-data - u USER -pPASSWORD DATABASE > /path/to/file/schema.sql

  Если нужно сделать дамп только одной или нескольких таблиц
  mysqldump -u USER -pPASSWORD DATABASE TABLE1 TABLE2 TABLE3 > /path/to/file/dump_table.sql

  Создаём бекап и сразу его архивируем
  mysqldump -u USER -pPASSWORD DATABASE | gzip > /path/to/outputfile.sql.gz

  Заливаем архив бекапа в базу
  gunzip < /path/to/outputfile.sql.gz | mysql -u USER -pPASSWORD DATABASE

FK ON DELETE/ON UPDATE
  CASCADE:
    Что происходит с записью в родительской таблице, тоже самое произойдет с записью в дочерних таблицах. Однако не забывайте, что здесь можно легко попасться в ловушку бесконечного цикла.

  SET NULL:
    если запись в родительской таблице обновлена или удалена,
    а мы хоти чтобы в дочерней таблице некоторым занчениям было присвоено NULL

  RESTRICT:
  NO ACTION:
    если связанные записи родительской таблицы обновляются или удаляются со значениями
    которые уже/еще содержатся в соответствующих записях дочерней таблицы,
    то база данных не позволит изменять записи в родительской таблице.
    Обе команды NO ACTION и RESTRICT эквивалентны отсутствию
    подвыражений ON UPDATE or ON DELETE для внешних ключей.


ALTER:
  ALTER TABLE table ADD [COLUMN]; - добавить колонку
  ALTER TABLE table DROP [COLUMN]; - удалить колонку

INSERT:
  Одну запись
  INSERT INTO table(column1,column2,...)
  VALUES(value_1,value_2,...);

  Несколько записей
  INSERT INTO table(column1,column2,...)
  VALUES(value_1,value_2,...),
        (value_1,value_2,...),
        (value_1,value_2,...).

UPDATE:
  UPDATE table SET column_1 = value_1,
    WHERE [условия]

DELETE
  DELETE FROM [table]; - удалить все записи
  TRUNCATE [table]; - удалить все записи
  DELETE FROM [table] WHERE [column] = [value]; - удаление записей по условию
  DROP TABLE [table]; - удалить таблицу




Права:
  CREATE USER 'newuser'@'localhost' IDENTIFIED BY 'password'; - создать пользователя
  DROP USER ‘demo’@‘localhost’; - удалить пользователя

  GRANT ALL PRIVILEGES ON database.* TO 'newuser'@'localhost'; - дать ему полные права на базу даных
  REVOKE ALL PRIVILEGES ON database.* TO 'newuser'@'localhost'; - забрать у него полные права на базу даных
    ALL PRIVILEGES - полный доступ к заданной базе данных (если база данных не указана, то ко всем)
    CREATE - позволяет создавать новые таблицы или базы данных
    DROP - позволяет удалять таблицы или базы данных
    DELETE - позволяет удалять строки из таблиц
    INSERT - позволяет добавлять строки в таблицу
    SELECT - поволит использовать команду Select для чтения из баз данных
    UPDATE - позволит редактировать строки таблиц
    GRANT OPTION - позволит назначать или удалять права доступа для других пользователей

  FLUSH PRIVILEGES; - применить изменения прав/пользователей

 */



CREATE TABLE IF NOT EXISTS lesson.students (
  id INT AUTO_INCREMENT NOT NULL,
  name CHAR(50) NOT NULL,
  age TINYINT NOT NULL,
  PRIMARY KEY(id)
) ENGINE=InnoDB CHARACTER SET=UTF8;

CREATE TABLE IF NOT EXISTS lesson.teachers (
  id INT AUTO_INCREMENT NOT NULL,
  name CHAR(50) NOT NULL,
  course_id INT NULL,
  PRIMARY KEY(id)
) ENGINE=InnoDB CHARACTER SET=UTF8;

CREATE TABLE IF NOT EXISTS lesson.courses (
  id INT NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  description TEXT NULL,
  PRIMARY KEY (id),
  INDEX `title` (`title`)
) ENGINE=InnoDB CHARACTER SET=UTF8;


ALTER TABLE lesson.teachers
  ADD
    CONSTRAINT `fk_course`
      FOREIGN KEY (`course_id`) REFERENCES lesson.courses (`id`)
      ON UPDATE CASCADE
      ON DELETE SET NULL;

#ALTER TABLE lesson.teachers AUTO_INCREMENT=999;
#ALTER TABLE lesson.teachers DROP COLUMN `title`;



/*

ALTER TABLE lesson.teachers ADD COLUMN course_id INT NULL;




ALTER TABLE lesson.teachers
  ADD CONSTRAINT 'fk_course'
  FOREIGN KEY ('course_ID') REFERENCES lessons.courses ('id')
  ON UPDATE SET NULL
  ON DELETE SET NULL
;