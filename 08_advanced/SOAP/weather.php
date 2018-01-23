<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 1/22/18
 * Time: 16:56
 */


//ini_set("soap.wsdl_cache_enabled", "0");

$wsdlEndpoint = 'http://www.webservicex.net/globalweather.asmx?WSDL';

try {
    //Create the client object
    $soapclient = new SoapClient($wsdlEndpoint,  [
        'trace' => 1,
        'cache_wsdl' => 'WSDL_CACHE_NONE',
        'soap_version' => 'SOAP_1_2',
        'user_agent' => 'PHP-SOAP/7.0.1',
        //'login' => 'web',
        //'password' => 'web',
    ]);

    var_dump($soapclient->__getFunctions());

    //Use the functions of the client
    $params = array('CountryName' => 'Italy', 'CityName' => 'Amendola');
    //$response = $soapclient->getWeather($params);
    $response = $soapclient->__call('getWeather', ['parameters' => $params]);
    var_dump($response);

    // Get the Cities By Country
    $param = array('CountryName' => 'Italy');


    $response = $soapclient->getCitiesByCountry($param);
    var_dump($response);
} catch (SoapFault $e) {
    echo $e->getMessage();
}