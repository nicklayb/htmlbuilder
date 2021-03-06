<?php

namespace Nicklayb\HtmlBuilder\Tags;

use Nicklayb\HtmlBuilder\Tag;

class Div extends Tag
{
    protected $tag = 'div';
    public function __construct($classes = [])
    {
        if (!is_array($classes)) {
            $classes = explode(' ', $classes);
        }

        $this->classes($classes);
    }
}
