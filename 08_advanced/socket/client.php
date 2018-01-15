<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 1/15/18
 * Time: 15:53
 */

$host    = "127.0.0.1";
$port    = 35323;
$message = $_GET['m'] ?: "привет сервер!";

header('Content-type: text/plain');

echo "Сообщение серверу :".$message.PHP_EOL;

// Создаем сокет
$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Не удалось создать сокет");

// Открываем соединение
$result = socket_connect($socket, $host, $port) or die("Не удалось открыть соединение");
// Отправляем сообщение
socket_write($socket, $message, mb_strlen($message)) or die("Не удалось отправить сообщение");
// Получаем ответ
$result = socket_read ($socket, 1024) or die("Не удалось прочитать ответ");

echo "Ответ сервера  :".$result;

// Закрываем сокет
socket_close($socket);