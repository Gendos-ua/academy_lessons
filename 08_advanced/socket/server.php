<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 1/15/18
 * Time: 15:53
 */

$host = "127.0.0.1";
$port = 35323;

header('Content-type: text/plain');

// Предотвратим окончание работы PHP по таймауту
set_time_limit(0);

// Создаем сокет
$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Не удалось создать сокет");

// Открываем соединение
$result = socket_bind($socket, $host, $port) or die("Не удалось открыть соединение");
$result = socket_listen($socket, 3) or die("Не удалось начать прослушивать соединение");

// Слушаем входящие соединения
// Создаем дополнительный сокет для отправки ответов
$spawn = socket_accept($socket) or die("Не удалось начать слушать входящие сообщения");

// Читаем входящее сообщение
$input = socket_read($spawn, 1024) or die("Не удалось прочитать сообщение");
$input = trim($input);
echo "Клиент прислал : ".$input;

// Отвечаем перевернутым сообщением через дополнительный сокет
$output = strrev($input) . "\n";
socket_write($spawn, $input, strlen ($output)) or die("Не удалось ответить на сообщение");

// Закрываем все сокеты
socket_close($spawn);
socket_close($socket);