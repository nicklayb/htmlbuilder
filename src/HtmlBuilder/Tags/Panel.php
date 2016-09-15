<?php

namespace Nicklayb\HtmlBuilder\Tags;

use Nicklayb\HtmlBuilder\Tags\Button as BaseButton;

class Button extends BaseButton
{
    public function __construct($color = 'default', $size = '')
    {
        __parent::__construct();
        $this->classes([
            'btn',
            ($size != '') ? 'btn-'.$size : '',
            'btn-'.$color
        ]);
    }
}
