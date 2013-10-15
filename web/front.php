<?php
require_once(__DIR__.'/../vendor/autoload.php');

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\EventDispatcher\EventDispatcher;

use Simplex\Framework;
use Simplex\ResponseEvent;
use Simplex\ContentLengthListener;
use Simplex\GoogleListener;

$request  = Request::createFromGlobals();

$routes   = include __DIR__.'/../src/app.php';

$context  = new RequestContext;
$context->fromRequest($request);

$matcher  = new UrlMatcher($routes, $context);
$resolver = new ControllerResolver;

$dispatcher = new EventDispatcher();
$dispatcher->addSubscriber(new ContentLengthListener);
$dispatcher->addSubscriber(new GoogleListener);

$framework = new Framework($dispatcher, $matcher, $resolver);
$response  = $framework->handle($request);
$response->send();

function render_template($request)
{
    extract($request->attributes->all(), EXTR_SKIP);
    ob_start();
    include sprintf(__DIR__.'/../src/pages/%s.php', $_route);
    return new Response(ob_get_clean());
}