<?php

namespace DavidNineRoc\Qrcode;

use Closure;
use DavidNineRoc\Qrcode\Contracts\PlusInterface;
use Endroid\QrCode\QrCode;

class QrCodePlus
{
    protected $qrcode;

    protected $output;

    public function __construct($text = '')
    {
        $this->qrcode = new QrCode($text);
    }

    public function output(PlusInterface $qrcode)
    {
        $imageString = $this->qrcode->writeString();

        $qrcode->create($imageString)
            ->build()
            ->output($this->output);
    }

    public function setOutput(Closure $closure)
    {
        $this->output = $closure;

        return $this;
    }

    public function getOutput(PlusInterface $qrcode)
    {
        ob_start();

        $this->output($qrcode);

        return ob_get_clean();
    }

    public function __call($method, $parameters)
    {
        $this->qrcode->$method(...$parameters);

        return $this;
    }
}
