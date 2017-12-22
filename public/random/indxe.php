<?php

require_once '../Requests/library/Requests.php';

Requests::register_autoloader();
echo "hello world";

$headers = array('Accept' => 'application/json');
//$options = array('auth' => array('3140171@myuwc.ac.za', '4a8b12d16u20l'));
$request = Requests::get('https://localhost:8000', $headers, $options);

var_dump($request->status_code);
// int(200)

var_dump($request->headers['content-type']);
// string(31) "application/json; charset=utf-8"

var_dump($request->body);
// string(26891) "[...]"
?>