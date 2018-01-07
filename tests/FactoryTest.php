<?php

namespace Tests;

use DavidNineRoc\Qrcode\Factory;
use DavidNineRoc\Qrcode\Foundation\Plus;
use PHPUnit\Framework\TestCase;

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
    }
}
