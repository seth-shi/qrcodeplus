<?php

    namespace QrCodePlus\Factory;


    use QrCodePlus\Exception\InvalidException;
    use QrCodePlus\PlusInterface;

    class FourColor implements PlusInterface
    {
        private $color;
        private $draw_color;
        private $img;

        public function __construct($type, $color)
        {
            if ($type != count($color))
            {
                throw new InvalidException('The number of colors and types do not match
');
            }

            $this->setColor($color);
        }

        /**
         * set color to private
         * @param $color
         * @throws InvalidException
         */
        public function setColor($color)
        {

            if (!is_array($color) || count($color) < 2)
            {
                throw new InvalidException('invalid color');
            }

            foreach ($color as $v)
            {

                $this->color[] = $v;
            }
        }

        /**
         *
         */
        public function createColor()
        {
            foreach ($this->color as $color)
            {
                $this->draw_color[] = imagecolorallocate($this->img, $color['r'], $color['g'], $color['b']);
            }
        }

        public function draw($img_str, $color)
        {
            $this->img = imagecreatefromstring($img_str);

            $this->createColor();


            // image width
            $width = imagesx($this->img);
            // image height
            $height = imagesy($this->img);



            // loop
            for ($i = 0; $i < $width; ++ $i)
            {
                for ($j = 0; $j < $height; $j++)
                {
                    // is black change color
                    $index = imagecolorat($this->img, $i, $j);

                    if ($index === 0)
                    {
                        // 第一部分
                        if ($i < $width/2 && $j  < $height/2)
                        {
                            imagesetpixel($this->img, $i , $j, $this->draw_color[0]);
                        }
                        elseif ($i >= $width/2 && $j  < $height/2)
                        {
                            imagesetpixel($this->img, $i , $j, $this->draw_color[1]);
                        }
                        elseif ($i < $width/2 && $j  >= $height/2)
                        {
                            imagesetpixel($this->img, $i , $j, $this->draw_color[2]);
                        }
                        elseif ($i >= $width/2 && $j  >= $height/2)
                        {
                            imagesetpixel($this->img, $i , $j, $this->draw_color[3]);
                        }
                    }

                }
            }

            // 调用原生的输出图像
            ob_end_clean();
            header('Content-Type: image/png');
            imagepng($this->img);

        }
    }