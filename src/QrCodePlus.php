<?php

namespace DavidNineRoc\Qrcode;

use DavidNineRoc\Qrcode\Contracts\PlusInterface;
use Endroid\QrCode\QrCode;

class QrCodePlus
{
    protected $qrcode;

    public function __construct($text = '')
    {
        $this->qrcode = new QrCode($text);
    }

    public function output(PlusInterface $qrcode)
    {
        $imageString = $this->qrcode->writeString();

        $qrcode->create($imageString)
            ->build()
            ->output();
    }

    public function __call($method, $parameters)
    {
        $this->qrcode->$method(...$parameters);

        return $this;
    }
}
