<?php

    namespace Waitmoonman\Qrcode\Factory;

    use Waitmoonman\Qrcode\Exception\InvalidException;

    class ImageStyle extends Base
    {
        private $dest_img;


        public function __construct($img_str, $hex_arr)
        {
            // 初始化图片
            $this->init($img_str, $hex_arr);
        }

        /**
         * init image attribute
         * @param $img_str
         * @param $type
         * @param $hex_arr
         * @throws InvalidException
         */
        public function init($img_str, $img_handle)
        {
            // create img resource
            $this->img = imagecreatefromstring($img_str);

            if (!$this->img)
            {
                throw new InvalidException('incalid image string');
            }

            // image width
            $this->img_width = imagesx($this->img);
            // image height
            $this->img_height = imagesy($this->img);

            // create a image
            $this->dest_img = imagecreate($this->img_width, $this->img_height);

            // copy and resize
            imagecopyresampled($this->dest_img, $img_handle, 0, 0, 0, 0, $this->img_width, $this->img_height, imagesx($img_handle), imagesy($img_handle));

        }

        /**
         * Build a 2D color code
         */
        public function build($alpha)
        {

            // Transparent must option
            imagealphablending($this->img, false);
            imagesavealpha($this->img, true);

            // loop img px
            for ($y = 0; $y < $this->img_width; ++ $y)
            {
                for ($x = 0; $x < $this->img_height; ++ $x)
                {
                    // is black change color
                    $color_index = imagecolorat($this->img, $x, $y);

                    // get color
                    $dest_index = imagecolorat($this->dest_img, $x, $y);
                    $c = imagecolorsforindex($this->dest_img, $dest_index);
                    $dest_color = imagecolorallocatealpha($this->img, $c['red'], $c['green'], $c['blue'], $alpha);

                    if ($color_index === 0)
                    {
                        // draw
                        imagesetpixel($this->img, $x , $y, $dest_color);
                    }

                }
            }

            // Call the native output image
            header('Content-Type: image/png');
            imagepng($this->img);
        }
    }