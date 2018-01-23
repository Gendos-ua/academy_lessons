<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 1/22/18
 * Time: 17:35
 */

set_time_limit(0);
header("Content-Type: text/xml; charset=utf-8");
header('Cache-Control: no-store, no-cache');
header('Expires: '.date('r'));


ini_set("soap.wsdl_cache_enabled", "0"); // отключаем кеширование WSDL-файла для тестирования


class SoapSmsGateWay
{
    public function sendSms($data)
    {
        file_put_contents(__DIR__.'/messages.log', print_r($data, 1), FILE_APPEND);

        return (object) [
            'status' => true,
        ];
    }
}

//Создаем новый SOAP-сервер
$server = new SoapServer("http://{$_SERVER['HTTP_HOST']}/08_advanced/SOAP/example/wsdl.php");
//Регистрируем класс обработчик
$server->setClass("SoapSmsGateWay");
//Запускаем сервер
$server->handle();