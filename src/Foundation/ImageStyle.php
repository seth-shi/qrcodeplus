<?php

namespace DavidNineRoc\Qrcode\Foundation;

use DavidNineRoc\Qrcode\Contracts\PlusInterface;

class ImageStyle extends Plus implements PlusInterface
{
    protected $alpha;

    protected $sourceImage;

    public function __construct($sourceImage = '', $alpha = 1)
    {
        if (!is_resource($sourceImage)) {
            $sourceImage = imagecreatefromstring($sourceImage);
        }

        $this->sourceImage = $sourceImage;
        $this->alpha = $alpha;
    }

    public function build($imageString)
    {
        $this->create($imageString);

        // loop img px
        for ($y = 0; $y < $this->imageWidth; ++$y) {
            for ($x = 0; $x < $this->imageHeight; ++$x) {
                // is black change color
                $colorIndex = imagecolorat($this->imageHandle, $x, $y);

                if (0 === $colorIndex) {
                    // 参数图的像素点
                    $sourceIndex = imagecolorat($this->sourceImage, $x, $y);
                    // 参数图的像素点颜色
                    $color = imagecolorsforindex($this->sourceImage, $sourceIndex);
                    // 要分配的颜色
                    $color = imagecolorallocatealpha($this->imageHandle, $color['red'], $color['green'], $color['blue'], $this->alpha);
                    imagesetpixel($this->imageHandle, $x, $y, $color);
                }
            }
        }

        $this->output();
    }
}
