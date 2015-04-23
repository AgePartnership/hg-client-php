<?php

namespace TheMarketingLab\Hg\Tests;

interface ViewInterface
{
    public function getSegment();
    /**
     * @return TestInterface|null
     */
    public function getTest();
}
