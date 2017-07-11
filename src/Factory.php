<?php

    namespace QrCodePlus;


    use QrCodePlus\Exception\InvalidException;
    use QrCodePlus\Factory\TwoColor;
    use QrCodePlus\Factory\FourColor;

    class Factory
    {
        private static $config = [
            2 => 'TwoColor',
            4 => 'FourColor',
            8 => 'EightColor',
            9 => 'ImageColor'
        ];

        /**
         * get class
         * @param $type
         * @return mixed
         * @throws InvalidException
         */
        public static function getInstance($type, $color)
        {

            if (!key_exists($type, self::$config))
            {
                throw new InvalidException('This type does not exist');
            }

            // Instantiation of class
            $class = self::$config[$type];
            // namespace
            $class = 'QrCodePlus\\Factory\\' . $class;

            return new $class($type, $color);
        }
    }