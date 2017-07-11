<?php

    namespace QrCodePlus;

    use Endroid\QrCode\ErrorCorrectionLevel;
    use Endroid\QrCode\LabelAlignment;
    use Endroid\QrCode\QrCode;
    use QrCodePlus\Factory\QrCodePlusFactory;
    use Symfony\Component\HttpFoundation\Response;

    class QrCodePlus extends QrCode
    {
        private $plus;


        public function __construct()
        {
            // 初始化父类
            parent::__construct();
        }

        /**
         * 绘制方法
         */
        public function build($type, $color)
        {
            // 获取图片的字符串
            $img_str = $this->writeString();

            // 工厂方法获取
            $plus = Factory::getInstance($type, $color);

            // 绘制
            $plus->draw($img_str, $color);

            // 输出
        }
    }