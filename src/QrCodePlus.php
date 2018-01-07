<?php

namespace DavidNineRoc\Qrcode;

use Endroid\QrCode\QrCode;

    class QrCodePlus extends QrCode
    {
        private $plus;

        public function __construct($string = '')
        {
            // init parent
            parent::__construct($string);
        }

        /**
         * Method of drawing core.
         */
        public function build($param, $alpha = 0)
        {
            // Get a picture of the string
            $img_str = $this->writeString();

            // factory get living example
            $plus = Factory::getInstance($img_str, $param);

            $plus->build($alpha);
        }
    }
