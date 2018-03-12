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

    /****************************************
     * 遍历图片的每一个像素点.
     *
     * @param Closure $closure
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

    /****************************************
     * 通过图片字符串创建图片
     * 并初始化图片的高度，透明度
     *
     * @param $imageString
     * @return $this
     * @throws InvalidException
     */
    public function create($imageString)
    {
        $this->imageHandle = imagecreatefromstring($imageString);

        if (!$this->imageHandle) {
            throw new InvalidException('invalid image string');
        }

        $this->imageWidth = imagesx($this->imageHandle);
        $this->imageHeight = imagesy($this->imageHandle);

        imagealphablending($this->imageHandle, false);
        imagesavealpha($this->imageHandle, true);

        return $this;
    }

    /****************************************
     * 实际输出图片方法，控制输出图片格式。
     *
     * @param null $output
     * @return bool
     */
    public function output($output = null)
    {
        if ($output instanceof Closure) {
            call_user_func($output, $this->imageHandle);

            return true;
        }

        // Call the native output image
        header('Content-Type: image/png');
        imagepng($this->imageHandle);
    }

    public function build()
    {
        throw new InvalidException('Please rewrite build method');
    }
}
