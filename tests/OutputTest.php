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
        $color = Factory::color(['#087', '#431', '#a2d', '#a2d',])->setOutput(function($handle){});

        $this->assertInstanceOf(Plus::class, $color);


        return $color;
    }


    /**
     * @depends testGetColor
     */
    public function testQrcode($color)
    {
        ob_start();

        (new QrCodePlus)
            ->setText('DavidNineRoc')
            ->setMargin(50)
            ->output($color);

        $qrcode = ob_get_clean();

        var_dump($qrcode);exit;
    }
}
