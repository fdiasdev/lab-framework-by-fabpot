<?php

class IndexTest extends PHPUnit_Framework_TestCase
{
    public function testHelloF()
    {
        $_GET['name'] = 'F';
        $_POST['name'] = 'post-f';

        ob_start();
        include(__DIR__.'/../index.php');
        $content = ob_get_clean();
        $this->assertEquals("Hello F", $content);
    }

    public function testHelloWorld()
    {
        ob_start();
        include(__DIR__.'/../index.php');
        $content = ob_get_clean();
        $this->assertEquals("Hello World", $content);
    }

}