# QrCodePlus

<p align="center">
<a href="https://packagist.org/packages/davidnineroc/qrcodeplus"><img src="https://travis-ci.org/DavidNineRoc/qrcodeplus.svg?branch=master" alt="Build Status"></a>
<a href="https://packagist.org/packages/davidnineroc/qrcodeplus"><img src="https://styleci.io/repos/96854420/shield?branch=master" alt="Style CI" Version"></a>
<a href="https://packagist.org/packages/davidnineroc/qrcodeplus"><img src="https://poser.pugx.org/davidnineroc/qrcodeplus/downloads" alt="Downloads"></a>
<a href="https://packagist.org/packages/davidnineroc/qrcodeplus"><img src="https://poser.pugx.org/laravel/passport/license.svg" alt="License"></a>
</p> 

## Feature
 - 基于[QR Code](https://github.com/endroid/QrCode) 的一个二维码包
 - 可以生成四色， 九色， 十六色， 背景图二维码
 - 后续功能增加中...
 
 ![四色二维码](http://or2pofbfh.bkt.clouddn.com/composer/four.png)
 ![九色二维码](http://or2pofbfh.bkt.clouddn.com/composer/nine.png)
 ![图片二维码](http://or2pofbfh.bkt.clouddn.com/composer/image.png)


## Requirement

1. PHP >= 7.1
2. **[composer](https://getcomposer.org/)**



## Installation

```shell
composer require davidnineroc/qrcodeplus
```

## Usage

基本使用: （九色）

```php
<?php
    
require 'vendor/autoload.php';

use DavidNineRoc\Qrcode\Factory;
use DavidNineRoc\Qrcode\QrCodePlus;

$qrcode = Factory::color([
    '#087',
    '#431',
    '#a2d',
    '#a2d',
]);

(new QrCodePlus)
    ->setText('DavidNineRoc')
    ->setMargin(50)
    ->output($qrcode);
```





## Documentation

## License

MIT
