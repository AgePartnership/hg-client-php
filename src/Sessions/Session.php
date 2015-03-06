<?php

namespace TheMarketingLab\Hg\Sessions;

class Session implements SessionInterface
{
    private $id;
    private $appId;
    private $test;

    public function __construct($id, $appId, TestInterface $test = null)
    {
        $this->id = $id;
        $this->appId = $appId;
        $this->test = $test;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAppId()
    {
        return $this->appId;
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
