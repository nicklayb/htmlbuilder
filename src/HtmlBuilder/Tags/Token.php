<?php

namespace Nicklayb\HtmlBuilder\Tags;

use Nicklayb\HtmlBuilder\Tag;

class Token extends Input
{
    public function __construct($value)
    {
        parent::__construct('hidden');
        $this->value($value);
    }
}
