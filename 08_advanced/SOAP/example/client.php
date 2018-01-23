<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 1/22/18
 * Time: 17:35
 */

ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);

// Заготовки объектов
class Message {
    public $phone;
    public $text;
    public $date;
    public $type;
}

class MessageList {
    public $message;
}

class Request {
    public $messageList;
}

// создаем объект для отправки на сервер
$req = new Request();
$req->messageList = new MessageList();

$msg1 = new Message();
$msg1->phone = '+380630000000';
$msg1->text = 'Тестовое сообщение 1';
$msg1->date = '2016-07-21T15:00:00.26';
$msg1->type = 15;

$msg2 = new Message();
$msg2->phone = '+380630000001';
$msg2->text = 'Тестовое сообщение 2';
$msg2->date = '2017-08-22T16:01:10';
$msg2->type = 16;

$msg3 = new Message();
$msg3->phone = '+380630000004';
$msg3->text = 'Тестовое сообщение 3';
$msg3->date = '2017-08-22T16:01:10';
$msg3->type = 17;


$req->messageList->message = [];
$req->messageList->message[] = $msg1;
$req->messageList->message[] = $msg2;
$req->messageList->message[] = $msg3;

$client = new SoapClient(
    "http://{$_SERVER['HTTP_HOST']}/08_advanced/SOAP/example/wsdl.php",
    ['soap_version' => SOAP_1_2]
);
var_dump($client->sendSms($req));