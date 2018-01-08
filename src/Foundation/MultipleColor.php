<?php

namespace DavidNineRoc\Qrcode\Foundation;

use DavidNineRoc\Qrcode\Support\Helper;

class MultipleColor extends Plus
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
    public function build()
    {
        $this->setColor($this->hexColor, $this->alpha);

        // Each column number
        $block = sqrt(count($this->penColor));

        $this->loopImagePoint(function ($x, $y) use ($block) {
            // In $i, $j drawing point
            $x_index = (int) floor($x / ($this->imageWidth / $block));
            $y_index = (int) floor($y / ($this->imageHeight / $block));

            // The plane is converted into the linear algorithm
            $index = $x_index + (2 * $y_index);

            // Across the line traversal
            imagesetpixel($this->imageHandle, $x, $y, $this->penColor[$index]);
        });

        return $this;
    }

    protected function setColor(array $colorParameters, $alpha)
    {
        foreach ($colorParameters as $color) {
            $color = self::hexChangeRgb($color);
            $this->penColor[] = imagecolorallocatealpha($this->imageHandle, $color['r'], $color['g'], $color['b'], $alpha);
        }
    }
}
