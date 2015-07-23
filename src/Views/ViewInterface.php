<?php

namespace TheMarketingLab\Hg\Views;

use TheMarketingLab\Hg\Tests\TestInterface;

interface ViewInterface
{
    public function getSegment();
    /**
     * @return TestInterface
     */
    public function getTest();
}
