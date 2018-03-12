<?php

namespace DavidNineRoc\Qrcode\Contracts;

interface PlusInterface
{
    /****************************************
     * 创建一个张图实例
     */
    public function create($imageString);

    /****************************************
     * 构建图片
     */
    public function build();

    /****************************************
     * 输出图片
     */
    public function output($output);
}
