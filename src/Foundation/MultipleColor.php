<?php

namespace DavidNineRoc\Qrcode\Foundation;


use DavidNineRoc\Qrcode\Contracts\PlusInterface;
use DavidNineRoc\Qrcode\Exception\InvalidException;
use DavidNineRoc\Qrcode\Support\Helper;

class MultipleColor extends Plus implements PlusInterface
{
    use Helper;

    protected $penColor;
    protected $hexColor;
    protected $alpha;


    public function __construct($hexColor = [], $alpha = 1)
    {
        $this->hexColor = $hexColor;
        $this->alpha = $alpha;
    }


    /**
     * Build a 2D color code.
     */
    public function build($imageString)
    {
        $this->create($imageString);
        $this->setColor($this->hexColor, $this->alpha);

        // Each column number
        $block = sqrt(count($this->penColor));

        // loop img px
        for ($y = 0; $y < $this->imageWidth; ++$y) {
            for ($x = 0; $x < $this->imageHeight; ++$x) {
                // is black change color
                $color_index = imagecolorat($this->imageHandle, $x, $y);

                if (0 === $color_index) {
                    // In $i, $j drawing point
                    $x_index = (int) floor($x / ($this->imageWidth / $block));
                    $y_index = (int) floor($y / ($this->imageHeight / $block));

                    // The plane is converted into the linear algorithm
                    $index = $x_index + (2 * $y_index);

                    // Across the line traversal
                    imagesetpixel($this->imageHandle, $x, $y, $this->penColor[$index]);
                }
            }
        }

        $this->output();
    }


    protected function setColor(array $colorParameters, $alpha)
    {
        foreach ($colorParameters as $color) {
            $color = self::hexChangeRgb($color);
            $this->penColor[] = imagecolorallocatealpha($this->imageHandle, $color['r'], $color['g'], $color['b'], $alpha);
        }
    }
}
