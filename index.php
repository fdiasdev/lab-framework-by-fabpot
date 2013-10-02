<?php

require_once(__DIR__.'/autoload.php');

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request  = Request::createFromGlobals();

// var_dump($request->query->all());
// var_dump($request->request->all());
// var_dump($request->server->all());
// var_dump($request->cookies->all());
// var_dump($request->headers->all());

$name     = $request->get('name', 'World');
$filtered = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);
$content  = sprintf('Hello %s', $filtered);
$response = new Response($content);
$response->send();
