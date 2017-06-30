<?php

namespace Fincallorca\TwigExtension\CssColorFromStringBundle\Twig;

/**
 * Class TwigCssColorFromString
 *
 * @package Fincallorca\TwigExtension\CssColorFromStringBundle
 */
class TwigCssColorFromString extends \Twig_Extension
{

	/**
	 * Returns an unsigned long (always 32 bit, machine byte order) of the submitted string.
	 *
	 * @param string $str
	 *
	 * @return integer
	 */
	protected function _get32bitHash($str)
	{
		return unpack('L', hash('adler32', $str, true))[ 1 ];
	}

	/**
	 * Returns a caclucalted color as hex value (example: `88ff22`) from a given string.
	 *
	 * @param string $str        the string to convert into a css hex color value (without the hash tag)
	 * @param float  $saturation [optional] the saturation announced between `0` and `1`, default is `0.5`
	 * @param float  $lightness  [optional] the lightness announced between `0` and `1`, default is `0.5`
	 *
	 * @return string the hex color value as string
	 */
	public function createHex($str, $saturation = .5, $lightness = .5)
	{
		return $this->_hsl2rgb($this->_get32bitHash($str) / 0xFFFFFFFF, $saturation, $lightness);
	}

	/**
	 * Retuns all available filters.
	 *
	 * @return \Twig_SimpleFilter[]
	 */
	public function getFilters()
	{
		return [
			new \Twig_SimpleFilter('hex', [$this, 'createHex'], [
				'is_safe' => ['html'],
			]),
		];
	}

	/**
	 * @param integer $hue
	 * @param integer $saturation
	 * @param integer $lightness
	 *
	 * @return string
	 */
	protected function _hsl2rgb($hue, $saturation, $lightness)
	{
		$hue       *= 6;
		$h         = intval($hue);
		$hue       -= $h;
		$lightness *= 255;

		$m = $lightness * ( 1 - $saturation );
		$x = $lightness * ( 1 - $saturation * ( 1 - $hue ) );
		$y = $lightness * ( 1 - $saturation * $hue );
		$a = [
				 [$lightness, $x, $m],
				 [$y, $lightness, $m],
				 [$m, $lightness, $x],
				 [$m, $y, $lightness],
				 [$x, $m, $lightness],
				 [$lightness, $m, $y],
			 ][ $h ];

		return sprintf("#%02X%02X%02X", $a[ 0 ], $a[ 1 ], $a[ 2 ]);
	}
}