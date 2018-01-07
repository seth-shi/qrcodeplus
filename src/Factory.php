<?php

namespace DavidNineRoc\Qrcode;

use DavidNineRoc\Qrcode\Exception\InvalidException;

    class Factory
    {
        private static $config = [
            // 图片背景
            0  => 'ImageStyle',
            // 四色二维码
            4  => 'MultipleColor',
            // 九色二维码
            9  => 'MultipleColor',
            // 十六色二维码
            16 => 'MultipleColor',
        ];

        /**
         * 获取预定义中的一个实例.
         * @param $type
         * @return mixed
         * @throws InvalidException
         */
        public static function getInstance($img_str, $param)
        {
            $type = null;

            // 判断类型
            if (is_resource($param)) {
                $type = 0;
            } elseif (is_array($param)) {
                $type = count($param);
            } else {
                throw new InvalidException('param invalid');
            }

            // 不存在预定义数组中的类型
            if (! array_key_exists($type, self::$config)) {
                throw new InvalidException('This type does not exist');
            }

            // 从预定义中取出类名
            $class = self::$config[$type];
            // 拼接命名空间
            $class = 'DavidNineRoc\\Qrcode\\Factory\\'.$class;

            return new $class($img_str, $param);
        }
    }
