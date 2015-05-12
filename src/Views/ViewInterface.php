<?php

namespace TheMarketingLab\Hg\Views;

interface ViewInterface
{
    public function getSegment();
    /**
     * @return TestInterface|null
     */
    public function getTest();
}
