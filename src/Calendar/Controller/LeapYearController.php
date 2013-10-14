<?php

namespace Calendar\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Calendar\Model\LeapYear;

class LeapYearController
{
    public function indexAction($year)
    {
        $response = new Response;
        $leapyear = new LeapYear();
        if ($leapyear->isLeapYear($year))
            $response->setContent('Its the year');
        else
            $response->setContent('No, shit!');
        return $response;
    }
}