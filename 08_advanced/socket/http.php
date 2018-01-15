<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 1/15/18
 * Time: 16:19
 */


error_reporting(E_ALL);
header('Content-type: text/plain');

/* Get the port for the WWW service. */
$service_port = getservbyname('www', 'tcp');

/* Get the IP address for the target host. */
$address = gethostbyname('www.google.com.ua');

/* Create a TCP/IP socket. */
$socket = socket_create(AF_INET, SOCK_STREAM, IPPROTO_IP)
        or "socket_create() failed: reason: " . socket_strerror(socket_last_error());

echo "Attempting to connect to '$address' on port '$service_port'...";


$result = socket_connect($socket, $address, $service_port)
        or "socket_connect() failed.\nReason: ($result) "
            .socket_strerror(socket_last_error($socket));

$in = "HEAD / HTTP/1.1\r\n";
$in .= "Host: www.google.com.ua\r\n";
$in .= "Connection: Close\r\n\r\n";
$out = '';

echo "Sending HTTP HEAD request...";
socket_write($socket, $in, strlen($in));
echo "OK.\n";

echo "Reading response:\n\n";
while ($out = socket_read($socket, 2048)) {
    echo $out;
}

socket_close($socket);