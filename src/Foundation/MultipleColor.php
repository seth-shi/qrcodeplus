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

    /****************************************
     * 通过计算得出图片的颜色 index.
     * 然后根据 index 得到图片当前位置的颜色
     * 遍历每一个位置把黑色换成当前设置的颜色
     *
     * @return $this
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

    /****************************************
     * 设置图片的颜色，十六进制数组
     *
     * @param array $colorParameters
     * @param $alpha
     */
    protected function setColor(array $colorParameters, $alpha)
    {
        foreach ($colorParameters as $color) {
            $color = self::hexChangeRgb($color);
            $this->penColor[] = imagecolorallocatealpha($this->imageHandle, $color['r'], $color['g'], $color['b'], $alpha);
        }
    }
}
