<?php

namespace Nicklayb\HtmlBuilder\Tags;

use Nicklayb\HtmlBuilder\Tag;

class A extends Tag
{
    protected $tag = 'a';

    public function href($link)
    {
        return $this->uniqueAttr('href', $link);
    }
}
