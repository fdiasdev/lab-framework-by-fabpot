<?php

namespace Simplex\Tests;

use Simplex\Framework;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use RuntimeException;

class FrameworkTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Simplex\Framework
     */
    public function testFrameworkReturnsResponseNotFound()
    {
        $matcher = $this->getMock('Symfony\Component\Routing\Matcher\UrlMatcherInterface');
        $matcher
            ->expects($this->once())
            ->method('match')
            ->will($this->throwException(new ResourceNotFoundException));

        $resolver = $this->getMock('Symfony\Component\HttpKernel\Controller\ControllerResolverInterface');

        $framework = new Framework($matcher, $resolver);

        $response = $framework->handle(new Request);

        $this->assertEquals(404, $response->getStatusCode());
    }

    /**
     * @covers \Simplex\Framework
     */
    public function testFrameworkReturnsResponseError()
    {
        $matcher = $this->getMock('Symfony\Component\Routing\Matcher\UrlMatcherInterface');
        $matcher
            ->expects($this->once())
            ->method('match')
            ->will($this->throwException(new RuntimeException));

        $resolver = $this->getMock('Symfony\Component\HttpKernel\Controller\ControllerResolverInterface');

        $framework = new Framework($matcher, $resolver);

        $response = $framework->handle(new Request);

        $this->assertEquals(500, $response->getStatusCode());
    }

    /**
     * @covers \Simplex\Framework
     */
    public function testFrameworkReturnsResponseOk()
    {
        $matcher = $this->getMock('Symfony\Component\Routing\Matcher\UrlMatcherInterface');
        $matcher
            ->expects($this->once())
            ->method('match')
            ->will($this->returnValue(
                array(
                    '_route'      => 'foo',
                    'name'        => 'Fabien',
                    '_controller' => function ($name) {
                        return new Response('Hello '.$name);
                    })
            ));

        $resolver  = new ControllerResolver;
        $framework = new Framework($matcher, $resolver);
        $response  = $framework->handle(new Request);

        $this->assertEquals(200, $response->getStatusCode());

    }
}