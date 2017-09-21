<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 9/20/17
 * Time: 16:27
 */

/**
 * @ref http://php.net/manual/ru/ref.filesystem.php - функции
 * @ref http://php.net/manual/ru/intro.stream.php - что такое потоки
 * @ref http://php.net/manual/ru/features.file-upload.php - загрузка файлов на сервер
 *
 * Конфигурация:
 * upload_max_filesize - макс. допустимый размер загуржаемого файла
 * upload_tmp_dir - временная директория для загружаемых файлов
 * post_max_size - макс. размер данных в теле POST запроса
 * max_input_time - сколько сервер ждет окончания загрузки файла
 * ограничение в html форме - <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
 *
 *
 * Чтение/запись/модификация:
 * file_get_contents - получить содержимое файла полностью
 * file_put_contents - записать данные в файл
 *
 *
 * -- Директории
 * mkdir - создать директорию
 * scandir - получить список файлов директории в виде массива
 * opendir - получить указатель директории
 * readdir - получить следующий файл в директории
 * closedir - закрыть указатель директории
 * rewinddir - сбросить указатель вначало директории
 *
 * -- Файлы
 * tmpfile - созадет временный файл
 * file - возвращает файл в виде массива строк
 * fopen r, r+, w, w+, a, a+ (t,b) - открыть и получить ресурс
 * fread - получить данные из потока
 * fputs(fwrite) - записать данные в поток
 * fgets - получить данные из потока (предложит ввести данные в консоли)
 * fseek - установить смещение (указатель) потока в нужное место
 * rewind - установить смещение вначало
 * feof - проверить на конец потока
 * fclose - закрыть поток
 * move_uploaded_file - переместить загруженный на сервер файл
 *
 * unlink - удалить файл/директорию
 * rename - переименовать/переместить файл/директорию
 * touch - обновить время модификации (filemtime) файла
 *
 * php://input (php://stdin) (STDIN)
 * php://output (STDOUT)
 * STDERR
 *
 * Права:
 * chmod - присвоить права:
 *          1 - выполнение
 *          2 - чтение
 *          4 - запись
 *          их комбинации : 0, 1, 3, 5, 6, 7
 *
 * chown - изменить владельца
 *
 * Мета-Информация:
 * stat - получить массив с мета-данными о файле
 * mime_content_type (finfo_file) - получить mime-type файла
 * is_file - файл ли это?
 * is_dir - директория ли это?
 * is_readable - доступен ли файл для чтения?
 * file_exists - существует ли файл?
 * is_uploaded_file - этот файл загружен на сервер POST запросом?
 * filemtime - время последнего изменения файла
 * basename - последний компонент в пути
 * dirname - путь к родительской директории
 *
 *
 * Разное:
 * glob - получить список файлов по шаблону:
 *      ? - один любой символ (но не /)
 *      * - 0 или больше любых символов (не /)
 *
 *
 */

ini_set('display_errors', 1);


$filename = 'data.txt';
$resource = fopen($filename, 'w');
fwrite($resource, 'first_line'.PHP_EOL);
fclose($resource);


unlink($filename);

if (file_exists($filename)) {
    echo 'exists!';
} else {
    echo 'not exists!';
}


echo '<pre>';

$filename = 'data2.txt';
$resource = fopen($filename, 'w+');

for ($i = 0; $i < 10; $i++) {
    fwrite(
        $resource,
        'line => ' . $i . PHP_EOL
    );
}

rewind($resource);

$c = 1;
while (!feof($resource)) {
    $data = fgets($resource);
    echo "iteration $c".PHP_EOL;
    $c++;
    echo $data.PHP_EOL;
}

fclose($resource);


touch('touched.txt');

print_r(stat($filename));




