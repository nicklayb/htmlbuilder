<?php

namespace Nicklayb\HtmlBuilder\Tags;

use Nicklayb\HtmlBuilder\Tag;

class Img extends Tag
{
    protected $tag = 'img';

    public function src($link)
    {
        return $this->uniqueAttr('src', $link);
    }
}
