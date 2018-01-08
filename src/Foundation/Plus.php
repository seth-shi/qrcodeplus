<?php

namespace DavidNineRoc\Qrcode\Foundation;

use Closure;
use DavidNineRoc\Qrcode\Contracts\PlusInterface;
use DavidNineRoc\Qrcode\Exception\InvalidException;
use Endroid\QrCode\QrCode;

class Plus implements PlusInterface
{
    protected $imageHandle;

    protected $imageWidth;

    protected $imageHeight;


    public function create($imageString)
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

        return $this;
    }

    public function build()
    {
        throw new InvalidException('Please rewrite build method');
    }

    protected function loopImagePoint(Closure $closure)
    {
        // loop img px
        for ($y = 0; $y < $this->imageHeight; ++$y) {
            for ($x = 0; $x < $this->imageWidth; ++$x) {
                // is black change color
                $color_index = imagecolorat($this->imageHandle, $x, $y);

                if (0 === $color_index) {
                    $closure($x, $y);
                }
            }
        }
    }

    public function output()
    {
        // Call the native output image
        header('Content-Type: image/png');
        imagepng($this->imageHandle);
    }
}
