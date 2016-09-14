<?php

namespace Nicklayb\HtmlBuilder\Tags;

use Nicklayb\HtmlBuilder\Tag;
use Nicklayb\HtmlBuilder\Tags\Table\Td;
use Nicklayb\HtmlBuilder\Tags\Table\Th;
use Nicklayb\HtmlBuilder\Tags\Table\Thead;
use Nicklayb\HtmlBuilder\Tags\Table\Tbody;
use Nicklayb\HtmlBuilder\Tags\Table\Tr;

class Table extends Tag
{
    protected $tag = 'table';

    public function __construct()
    {
        $this->child(new Thead, 'thead');
        $this->child(new Tbody, 'tbody');
    }

    public function head($header = [])
    {
        $tr = new Tr;
        foreach ($header as $key => $value) {
            $tag = $value;
            if (!($value instanceof Th)) {
                $tag = new Th;
                $tag->content($value);
            }
            $tr->child($tag);
        }
        $this->childs['thead']->child($tr);
        return $this;
    }

    public function body($header = [])
    {
        foreach ($header as $key => $value) {
            $tr = new Tr;
            foreach ($value as $subkey => $subvalue) {
                $tag = new Td;
                $tag->content($value);
                $tr->child($tag);
            }
            $this->childs['tbody']->child($tr);
        }
        return $this;
    }
}
