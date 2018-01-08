<?php

namespace DavidNineRoc\Qrcode\Foundation;

use Closure;
use DavidNineRoc\Qrcode\Contracts\PlusInterface;
use DavidNineRoc\Qrcode\Exception\InvalidException;

class Plus implements PlusInterface
{
    // 二维码图片的句柄
    protected $imageHandle;
    // 二维码图片的宽
    protected $imageWidth;
    // 二维码图片的高
    protected $imageHeight;


    /**
     * 遍历图片的每一个像素点
     */
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

    public function create($imageString)
    {
        // create img resource
        $this->imageHandle = imagecreatefromstring($imageString);

        if (!$this->imageHandle) {
            throw new InvalidException('invalid image string');
        }

        $this->imageWidth = imagesx($this->imageHandle);
        $this->imageHeight = imagesy($this->imageHandle);
        // Transparent must optio
        imagealphablending($this->imageHandle, false);
        imagesavealpha($this->imageHandle, true);

        return $this;
    }

    public function output()
    {
        // Call the native output image
        header('Content-Type: image/png');
        imagepng($this->imageHandle);
    }

    public function build()
    {
        throw new InvalidException('Please rewrite build method');
    }
}
