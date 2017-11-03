<?php

namespace StatBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class StatBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
