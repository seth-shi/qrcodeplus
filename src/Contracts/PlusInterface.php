<?php

namespace DavidNineRoc\Qrcode\Contracts;

interface PlusInterface
{
    public function create($imageString);

    public function build();

    public function output();
}
