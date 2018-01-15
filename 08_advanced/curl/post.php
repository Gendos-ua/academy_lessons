<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 1/15/18
 * Time: 18:16
 */

$params=['secret'=>'4nfflkn42rnk2l3krn2l3', 'login'=>'admin', 'password'=>'p1assword'];

$options = [
    CURLOPT_URL => 'http://academy.io/08_advanced/curl/auth.php',
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_POSTFIELDS => ['payload' => json_encode($params)],//http_build_query($params),
    //CURLOPT_SSL_VERIFYPEER => false,
];

$ch = curl_init();
curl_setopt_array($ch, $options);

$output = curl_exec($ch);

if (!$output) {
    echo curl_errno($ch) . ':' . curl_error($ch);
}

curl_close($ch);

var_dump($output);