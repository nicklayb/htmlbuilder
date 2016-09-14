<?php

namespace Nicklayb\HtmlBuilder\Tags;

use Nicklayb\HtmlBuilder\Tag;

class Input extends Tag
{
    protected $tag = 'input';
    protected $selfClosingTag = true;

    public function __construct($type = 'text')
    {
        $this->type($type);
    }

    public function value($value)
    {
        return $this->attr('value', $value, true);
    }
}
