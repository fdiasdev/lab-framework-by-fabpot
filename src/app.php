<?php

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\HttpFoundation\Response;

$routes = new RouteCollection;

$routes->add('hello', new Route('hello/{name}', array(
    'name'        => 'World',
    '_controller' => function($request) {
        $request->attributes->set('foo', 'app');
        $response = render_template($request);
        $response->headers->set('Content-Type', 'text/plain');
        return $response;
    }
)));

$routes->add('year', new Route('year/{year}', array(
    'year'        => null,
    '_controller' => '\\Calendar\\Controller\\LeapYearController::indexAction',
)));

$routes->add('bye', new Route('bye'));

return $routes;
