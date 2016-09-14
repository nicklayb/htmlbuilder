<?php

namespace Nicklayb\HtmlBuilder\Tags;

class Select extends Input
{
    protected $tag = 'select';
    protected $selfClosingTag = false;

    protected $options = [];

    public function __construct($options = [], $multiple = false)
    {
        foreach ($options as $key => $value) {
            $this->option($key, $value);
        }
        $this->content($this->makeOptions());
        if ($multiple) {
            $this->multiple();
        }
    }

    public function multiple()
    {
        return $this->boolAttr('multiple');
    }

    public function option($value, $text = null)
    {
        return $this->child(new Option($value, $text));
    }

    public function makeOptions()
    {
        $output = '';
        foreach ($this->options as $key => $value) {
            $output .= $value->make();
        }
        return $output;
    }
}
