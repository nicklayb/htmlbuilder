<?php

namespace Nicklayb\HtmlBuilder\Tags;

use Nicklayb\HtmlBuilder\Tag;

class Icon extends Tag
{
    protected $tag = 'i';

    public function __construct($icon)
    {
        if (!(substr($icon, 0, 3) == 'fa-')) {
            $icon = 'fa-'.$icon;
        }
        $this->classes([
            'fa',
            $icon
        ]);
    }
}
