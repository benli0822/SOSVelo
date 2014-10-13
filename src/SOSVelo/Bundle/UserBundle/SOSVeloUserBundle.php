<?php

namespace SOSVelo\Bundle\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SOSVeloUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
