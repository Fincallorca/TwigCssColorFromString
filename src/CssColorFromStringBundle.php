<?php

namespace Fincallorca\TwigExtension\CssColorFromStringBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Fincallorca\TwigExtension\CssColorFromStringBundle\DependencyInjection\CssColorFromStringBundleExtension;

/**
 * Class CssColorFromStringBundle
 *
 * @package Fincallorca\TwigExtension\CssColorFromStringBundle
 */
class CssColorFromStringBundle extends Bundle
{
	public function getContainerExtension()
	{
		return new CssColorFromStringBundleExtension();
	}
}
