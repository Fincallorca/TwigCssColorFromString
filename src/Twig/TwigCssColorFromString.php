<?php

namespace Fincallorca\TwigExtension\CssColorFromStringBundle\Twig;

class TwigCssColorFromString extends \Twig_Extension
{

    /**
     * returns an unsigned long (always 32 bit, machine byte order)
     *
     * @param $str
     *
     * @return integer
     */
    protected function _get32bitHash($str)
    {
        return unpack('L', hash('adler32', $str, true))[ 1 ];
    }

    public function createHex($str, $saturation = .5, $lightness = .5)
    {
        return $this->_hsl2rgb($this->_get32bitHash($str) / 0xFFFFFFFF, $saturation, $lightness);
    }


    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('hex', [$this, 'createHex'], [
                'is_safe' => ['html'],
            ]),
        ];
    }

    protected function _hsl2rgb($hue, $saturation, $lightness)
    {
        $hue       *= 6;
        $h         = intval($hue);
        $hue       -= $h;
        $lightness *= 255;

        $m = $lightness * (1 - $saturation);
        $x = $lightness * (1 - $saturation * (1 - $hue));
        $y = $lightness * (1 - $saturation * $hue);
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