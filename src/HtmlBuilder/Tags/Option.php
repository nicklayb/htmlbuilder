<?php

namespace Nicklayb\HtmlBuilder\Tags;

class Option extends Input
{
    protected $tag = 'option';
    protected $selfClosingTag = false;

    public function __construct($value, $text = null)
    {
        $text = ($text != null) ? $text : $value;

        $this->value($value);
        $this->content($text);
    }
}
