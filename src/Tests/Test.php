<?php

namespace TheMarketingLab\Hg\Tests;

class Test implements TestInterface
{
    private $id;
    private $variant;

    public function __construct($id, $variant)
    {
        $this->id = $id;
        $this->variant = $variant;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getVariant()
    {
        return $this->variant;
    }
}
