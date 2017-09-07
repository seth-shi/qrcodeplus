<?php

    namespace Waitmoonman\Qrcode;


    use Waitmoonman\Qrcode\Exception\InvalidException;

    class Factory
    {
        private static $config = [
            0  => 'ImageStyle',
            4  => 'MultipleColor',
            9  => 'MultipleColor',
            16 => 'MultipleColor'
        ];

        /**
         * get class
         * @param $type
         * @return mixed
         * @throws InvalidException
         */
        public static function getInstance($img_str, $param)
        {
            $type = null;
            if (is_resource($param))
            {
                $type = 0;
            }
            elseif (is_array($param))
            {
                $type = count($param);
            }
            else
            {
                throw new InvalidException('param invalid');
            }


            // is exists option
            if (!key_exists($type, self::$config))
            {
                throw new InvalidException('This type does not exist');
            }

            // Instantiation of class
            $class = self::$config[$type];
            // namespace
            $class = 'Waitmoonman\\Qrcode\\Factory\\' . $class;

            return new $class($img_str, $param);
        }
    }