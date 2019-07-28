<?php declare(strict_types=1);

$address = '127.0.0.1';
$port = 8080;

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_bind($socket, $address, $port);
socket_listen($socket);

echo $address . ':'. $port . "\n";

while (true) {
    $connection = socket_accept($socket);
    $body = 'Hello world';
    $message = 'HTTP/1.1 200 OK';
    $message .= "\n" . 'Content-Length: ' . strlen($body);
    $message .= "\n" . 'Content-Type: text/html; charset=utf-8';
    $message .= "\n" . 'Connection: close';
    $message .= "\n\n" . $body;
    socket_write($connection, $message, strlen($message));
    socket_close($connection);
}