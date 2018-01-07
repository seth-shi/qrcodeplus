<?php

namespace DavidNineRoc\Qrcode\Factory;

use DavidNineRoc\Qrcode\Exception\InvalidException;
use DavidNineRoc\Qrcode\Helper;

class MultipleColor extends Base
{
    use Helper;

    /**
     * the color of the pen.
     *
     * @array
     */
    private $pen_color;

    private $hex_arr;

    /**
     * FourColor constructor.
     *
     * @param $img_str
     * @param $type
     * @param $hex_arr
     *
     * @throws InvalidException
     */
    public function __construct($img_str, $hex_arr)
    {
        $this->init($img_str);

        $this->hex_arr = $hex_arr;
    }

    /**
     * init image attribute.
     *
     * @param $img_str
     * @param $type
     * @param $hex_arr
     *
     * @throws InvalidException
     */
    public function init($img_str)
    {
        // create img resource
        $this->img = imagecreatefromstring($img_str);

        if (!$this->img) {
            throw new InvalidException('incalid image string');
        }

        // image width
        $this->img_width = imagesx($this->img);
        // image height
        $this->img_height = imagesy($this->img);
    }

    /**
     * set color to private.
     *
     * @param $pen_color
     *
     * @throws InvalidException
     */
    public function setColor($alpha)
    {
        // The sixteen hexadecimal color conversion to RGB
        $color = [];
        foreach ($this->hex_arr as $hex) {
            $color[] = self::hexChangeRgb($hex);
        }

        // set pen color is array
        foreach ($color as $c) {
            $this->pen_color[] = imagecolorallocatealpha($this->img, $c['r'], $c['g'], $c['b'], $alpha);
        }
    }

    /**
     * Build a 2D color code.
     */
    public function build($alpha)
    {
        // Transparent must optio
        imagealphablending($this->img, false);
        imagesavealpha($this->img, true);

        // set color
        $this->setColor($alpha);

        // Each column number
        $block = sqrt(count($this->pen_color));

        // loop img px
        for ($y = 0; $y < $this->img_width; ++$y) {
            for ($x = 0; $x < $this->img_height; ++$x) {
                // is black change color
                $color_index = imagecolorat($this->img, $x, $y);

                if (0 === $color_index) {
                    // In $i, $j drawing point
                    $x_index = (int) floor($x / ($this->img_width / $block));
                    $y_index = (int) floor($y / ($this->img_height / $block));

                    // The plane is converted into the linear algorithm
                    $index = $x_index + (2 * $y_index);

                    // Across the line traversal
                    imagesetpixel($this->img, $x, $y, $this->pen_color[$index]);
                }
            }
        }

        // Call the native output image
        header('Content-Type: image/png');
        imagepng($this->img);
    }

    /**
     * destory image resource.
     */
    public function __destruct()
    {
        imagedestroy($this->img);
    }
}
