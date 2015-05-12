<?php

namespace TheMarketingLab\Hg\Views;

use TheMarketingLab\Hg\Tests\TestInterface;

class View implements ViewInterface
{
    private $segment;
    private $test;

    public function __construct($segment, TestInterface $test = null)
    {
        $this->segment = $segment;
        $this->test = $test;
    }

    public function getSegment()
    {
        return $this->segment;
    }

    public function getTest()
    {
        return $this->test;
    }
}
