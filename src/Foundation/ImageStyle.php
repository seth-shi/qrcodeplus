<?php

namespace DavidNineRoc\Qrcode\Foundation;

class ImageStyle extends Plus
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

    /****************************************
     * 遍历图片的每一个像素点
     * 如果当前点是黑色，然后把当前点替换成传入
     * 图片的像素点颜色
     *
     * @return $this
     */
    public function build()
    {
        $this->resizeImage();

        $this->loopImagePoint(function ($x, $y) {
            // 参数图的像素点
            $sourceIndex = imagecolorat($this->sourceImage, $x, $y);

            // 参数图的像素点颜色
            $color = imagecolorsforindex($this->sourceImage, $sourceIndex);
            // 要分配的颜色
            $color = imagecolorallocatealpha($this->imageHandle, $color['red'], $color['green'], $color['blue'], $this->alpha);

            imagesetpixel($this->imageHandle, $x, $y, $color);
        });

        return $this;
    }

    /****************************************
     * 把传入的参数图片设置成二维码图片大小
     *
     * @return $this
     */
    protected function resizeImage()
    {
        $tmpImg = imagecreate($this->imageWidth, $this->imageHeight);

        imagecopyresized(
            $tmpImg,
            $this->sourceImage,
            0,
            0,
            0,
            0,
            $this->imageWidth,
            $this->imageHeight,
            imagesx($this->sourceImage),
            imagesy($this->sourceImage)
        );

        imagedestroy($this->sourceImage);
        $this->sourceImage = $tmpImg;
    }
}
