<?php

namespace Tests;

use DavidNineRoc\Qrcode\Factory;
use DavidNineRoc\Qrcode\Foundation\Plus;
use DavidNineRoc\Qrcode\QrCodePlus;
use PHPUnit\Framework\TestCase;

class OutputTest extends TestCase
{
    /****************************************
     * 返回基类符合要求
     *
     * @return \DavidNineRoc\Qrcode\Contracts\PlusInterface $qrcode
     */
    public function testGetColor()
    {
        $color = Factory::color(['#087', '#431', '#a2d', '#a2d']);

        $this->assertInstanceOf(Plus::class, $color);

        return $color;
    }

    /****************************************
     * 正确的返回一张图片
     *
     * @depends testGetColor
     * @param $color
     */
    public function testQrcode($color)
    {
        $qrcode = (new QrCodePlus())
                    ->setText('DavidNineRoc')
                    ->setMargin(50)
                    ->setOutput(function ($handle) {
                        imagepng($handle);
                    })
                    ->getOutput($color);

        $this->assertTrue((bool) imagecreatefromstring($qrcode));
    }
}
