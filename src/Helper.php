<?php

namespace DavidNineRoc\Qrcode;

use DavidNineRoc\Qrcode\Exception\InvalidException;

trait Helper
{
    /**
     * 十六进制转换成RGB颜色值
     *
     * @param $hex
     *
     * @return array
     *
     * @throws InvalidException
     */
    public static function hexChangeRgb($hex)
    {
        if (!is_string($hex) && '#' !== $hex[0]) {
            throw new InvalidException('invalid hexadecimal color');
        }

        $hex = substr($hex, 1);

        $color = [];
        if (3 === strlen($hex)) {
            $color['r'] = hexdec(substr($hex, 0, 1).substr($hex, 0, 1));
            $color['g'] = hexdec(substr($hex, 1, 1).substr($hex, 1, 1));
            $color['b'] = hexdec(substr($hex, 2, 1).substr($hex, 2, 1));
        } elseif (6 === strlen($hex)) {
            $color['r'] = hexdec(substr($hex, 0, 2));
            $color['g'] = hexdec(substr($hex, 2, 2));
            $color['b'] = hexdec(substr($hex, 4, 2));
        } else {
            throw new InvalidException('invalid hexadecimal color count');
        }

        return $color;
    }
}
