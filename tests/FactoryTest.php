<?php

namespace Tests;

use DavidNineRoc\Qrcode\Factory;
use DavidNineRoc\Qrcode\QrCodePlus;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    public function testImageCreate()
    {
        $qrcode = (new QrCodePlus('DavidNineRoc'))->writeString();

        $this->assertNotEmpty($qrcode);

        return $qrcode;
    }

    /**
     * @depends testImageCreate
     */
    public function testFactory($str)
    {
        $qrcode = Factory::getInstance($str, ['#087', '#047', '#017', '#080']);

        $this->assertInstanceOf(Factory\Base::class, $qrcode);
    }
}
