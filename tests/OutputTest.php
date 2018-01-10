<?php

namespace Tests;

use DavidNineRoc\Qrcode\Factory;
use DavidNineRoc\Qrcode\Foundation\Plus;
use DavidNineRoc\Qrcode\QrCodePlus;
use PHPUnit\Framework\TestCase;

class OutputTest extends TestCase
{
    public function testGetColor()
    {
        $color = Factory::color(['#087', '#431', '#a2d', '#a2d',]);

        $this->assertInstanceOf(Plus::class, $color);


        return $color;
    }


    /**
     * @depends testGetColor
     */
    public function testQrcode($color)
    {
        $qrcode = (new QrCodePlus)
                    ->setText('DavidNineRoc')
                    ->setMargin(50)
                    ->setOutput(function($handle){
                        imagepng($handle);
                    })
                    ->getOutput($color);

        $this->assertTrue((bool)imagecreatefromstring($qrcode));
    }
}
