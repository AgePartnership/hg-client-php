<?php

namespace TheMarketingLab\Hg\Sessions;

class Session implements SessionInterface
{
    private $id;
    private $test;

    public function __construct($id, TestInterface $test = null)
    {
        $this->id = $id;
        $this->test = $test;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTest()
    {
        return $this->test;
    }

    public function addTest(TestInterface $test)
    {
        $this->test = $test;
    }
}
