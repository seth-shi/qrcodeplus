<?php

namespace DavidNineRoc\Qrcode\Foundation;

use DavidNineRoc\Qrcode\Exception\InvalidException;
use Endroid\QrCode\QrCode;

class Plus
{
    protected $imageHandle;

    protected $imageWidth;

    protected $imageHeight;


    protected function create($imageString)
    {
        // create img resource
        $this->imageHandle = imagecreatefromstring($imageString);

        if (! $this->imageHandle) {
            throw new InvalidException('invalid image string');
        }

        $this->imageWidth = imagesx($this->imageHandle);
        $this->imageHeight = imagesy($this->imageHandle);
        // Transparent must optio
        imagealphablending($this->imageHandle, false);
        imagesavealpha($this->imageHandle, true);
    }

    protected function output()
    {
        // Call the native output image
        header('Content-Type: image/png');
        imagepng($this->imageHandle);
    }
}
