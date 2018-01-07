<?php

namespace Tests;

use Endroid\QrCode\QrCode;
use PHPUnit\Framework\TestCase;
use DavidNineRoc\Qrcode\QrCodePlus;

class QrcodePlusTest extends TestCase
{
    public function testInstanceOf()
    {
        $this->assertInstanceOf(QrCode::class, new QrCodePlus);
    }

    public function testBuilder()
    {
        $qrcode = (new QrCodePlus('DavidNineRoc'))->writeString();

        $this->assertNotFalse((bool) imagecreatefromstring($qrcode));
    }
}
