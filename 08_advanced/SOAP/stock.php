<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 1/22/18
 * Time: 17:07
 */


ini_set("soap.wsdl_cache_enabled", "0");
$wsdlEndpoint = 'http://www.webservicex.net/stockquote.asmx?WSDL';

try {
    $soapclient = new SoapClient($wsdlEndpoint, [
        'trace' => 1,
        'cache_wsdl' => 'WSDL_CACHE_NONE',
        'soap_version' => 'SOAP_1_2',
        'user_agent' => 'PHP-SOAP/7.0.1',
    ]);

    $params = array('symbol' => 'AAPL');
    $response = $soapclient->GetQuote($params);

    var_dump($response);

} catch (SoapFault $e) {
    echo $e->getMessage();
}