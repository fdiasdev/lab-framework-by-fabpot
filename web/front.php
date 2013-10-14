<?php
require_once(__DIR__.'/../vendor/autoload.php');

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;

use Simplex\Framework;

$request  = Request::createFromGlobals();

$routes   = include __DIR__.'/../src/app.php';

$context  = new RequestContext;
$context->fromRequest($request);

$matcher  = new UrlMatcher($routes, $context);
$resolver = new ControllerResolver;

//var_dump($request->query->all());
//var_dump($request->getPathInfo());

$framework = new Framework($matcher, $resolver);
$response  = $framework->handle($request);
$response->send();

function render_template($request)
{
    extract($request->attributes->all(), EXTR_SKIP);
    ob_start();
    include sprintf(__DIR__.'/../src/pages/%s.php', $_route);
    return new Response(ob_get_clean());
}