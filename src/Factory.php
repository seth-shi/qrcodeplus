<?php

    namespace QrCodePlus;


    use QrCodePlus\Exception\InvalidException;

    class Factory
    {
        private static $config = [
            4  =>  'MultipleColor',
            9  =>  'MultipleColor',
            16 =>  'MultipleColor'
        ];

        /**
         * get class
         * @param $type
         * @return mixed
         * @throws InvalidException
         */
        public static function getInstance($img_str, $color)
        {
            $type = count($color);

            // is exists option
            if (!key_exists($type, self::$config))
            {
                throw new InvalidException('This type does not exist');
            }

            // Instantiation of class
            $class = self::$config[$type];
            // namespace
            $class = 'QrCodePlus\\Factory\\' . $class;

            return new $class($img_str, $color);
        }
    }