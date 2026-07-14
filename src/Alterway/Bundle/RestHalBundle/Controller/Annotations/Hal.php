<?php

namespace Alterway\Bundle\RestHalBundle\Controller\Annotations;

#[\Attribute(\Attribute::TARGET_METHOD)]
class Hal
{
    public function __construct(public int $code = 200)
    {
    }
}