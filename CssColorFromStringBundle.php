<?php

namespace Fincallorca\TwigExtension\CssColorFromStringBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Fincallorca\TwigExtension\CssColorFromStringBundle\DependencyInjection\CssColorFromStringBundleExtension;

class CssColorFromStringBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new CssColorFromStringBundleExtension();
    }
}
