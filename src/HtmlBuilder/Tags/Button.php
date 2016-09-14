<?php

namespace Nicklayb\HtmlBuilder\Tags;

use Nicklayb\HtmlBuilder\Tag;

class Button extends Tag
{
    protected $tag = 'button';

    public function __construct($type = 'button', $name = '')
    {
        $this->type($type);
        $this->name($name);
    }
}
