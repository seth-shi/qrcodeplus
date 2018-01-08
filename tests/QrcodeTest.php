<?php

namespace Tests;

use DavidNineRoc\Qrcode\QrCodePlus;
use Endroid\QrCode\QrCode;
use PHPUnit\Framework\TestCase;

class QrcodeTest extends TestCase
{
    public function testQrcode()
    {
        $this->assertNotInstanceOf(Qrcode::class, new QrCodePlus());
    }
}
