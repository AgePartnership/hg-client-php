<?php

namespace TheMarketingLab\Hg\Sessions;

interface SessionInterface
{
    public function getId();
    public function getTest();
    public function addTest(TestInterface $test);
}
