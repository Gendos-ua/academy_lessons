<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 1/15/18
 * Time: 18:14
 */

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "www.google.com.ua");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_NOBODY, 1);

$output = curl_exec($ch);

if (!$output) {
    echo curl_errno($ch) . ':' . curl_error($ch);
}

curl_close($ch);

echo $output;