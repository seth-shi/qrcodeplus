<?php

namespace Tests;

use DavidNineRoc\Qrcode\Factory;
use DavidNineRoc\Qrcode\Foundation\Plus;
use DavidNineRoc\Qrcode\QrCodePlus;
use PHPUnit\Framework\TestCase;
use ReflectionMethod;

class FactoryTest extends TestCase
{
    public function testImageCreate()
    {
        $color = Factory::color([
            '#087',
            '#431',
            '#a2d',
            '#a2d',
        ]);

        $this->assertInstanceOf(Plus::class, $color);

        return $color;
    }

}
