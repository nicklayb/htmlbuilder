<?php

namespace Nicklayb\HtmlBuilder\Tags;

use Nicklayb\HtmlBuilder\Tag;

class A extends Tag
{
    protected $tag = 'a';

    public function __construct($href = null)
    {
        if ($href != null) {
            $this->href($href);
        }
    }

    public function href($link)
    {
        return $this->uniqueAttr('href', $link);
    }
}
