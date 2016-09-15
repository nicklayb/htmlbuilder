<?php

namespace Nicklayb\HtmlBuilder;

class Tag
{
    protected $tag;
    protected $attributes = [];
    protected $booleanAttributes = [];
    protected $childs = [];
    protected $content = "";
    protected $selfClosingTag = false;

    public function make()
    {
        $attributes = $this->makeAllAttributes();
        if ($this->isSelfClosingTag()) {
            return $this->makeOpeningTag($attributes);
        } else {
            return $this->makeOpeningTag($attributes).$this->getContent().$this->makeClosingTag();
        }
    }

    public function makeAttributes()
    {
        $compiled = [];
        foreach ($this->attributes as $key => $value) {
            $compiled[] = $this->makeAttribute($key, $this->attributes[$key]);
        }
        return implode(' ', $compiled);
    }

    public function makeChilds()
    {
        $output = '';
        foreach ($this->childs as $key => $value) {
            $output .= $value->make();
        }
        return $output;
    }

    public function makeAllAttributes()
    {
        return $this->makeAttributes().' '.$this->makeBooleanAttributes();
    }

    public function makeBooleanAttributes()
    {
        $compiled = [];
        foreach ($this->booleanAttributes as $key => $value) {
            $compiled[] = $this->makeAttribute($key, ($value) ? $key : '');
        }
        return implode(' ', $compiled);
    }

    public function makeAttribute($attribute, $values)
    {
        if (!is_array($values)) {
            $values = [$values];
        }
        return $attribute.'="'.implode(' ', $values).'"';
    }

    public function makeOpeningTag($innerTag = '')
    {
        return '<'.$this->getTag().' '.$innerTag.(($this->isSelfClosingTag()) ? '/' : '').'>';
    }

    public function isSelfClosingTag()
    {
        return $this->selfClosingTag;
    }

    public function makeClosingTag()
    {
        return '</'.$this->getTag().'>';
    }

    public function getTag()
    {
        return $this->tag;
    }

    public function attr($name, $value, $unique = false)
    {
        if ($unique && is_array($value)) {
            $value = $value[0];
        } elseif (!$unique) {
            if (!is_array($value)) {
                $value = explode(' ', $value);
            }
            if (isset($this->attributes[$name])) {
                $value = array_merge($this->attributes[$name], $value);
            }
        }

        $this->attributes[$name] = $value;
        return $this;
    }

    public function uniqueAttr($name, $value)
    {
        return $this->attr($name, $value, true);
    }

    public function boolAttr($name, $value = true)
    {
        $this->booleanAttributes[$name] = $value;
        return $this;
    }

    public function tabIndex($value)
    {
        return $this->uniqueAttr('class', $value);
    }

    public function id($value)
    {
        return $this->uniqueAttr('id', $value);
    }

    public function child(Tag $tag, $key = null)
    {
        if ($key != null) {
            $this->childs[$key] = $tag;
        } else {
            $this->childs[] = $tag;
        }
        return $this;
    }

    public function type($value)
    {
        return $this->uniqueAttr('type', $value);
    }

    public function name($value)
    {
        return $this->uniqueAttr('name', $value);
    }

    public function title($text)
    {
        return $this->attr('title', $text, true);
    }

    public function classes($values)
    {
        return $this->attr('class', $values);
    }

    public function tag($tag)
    {
        $this->tag = $tag;
        return $this;
    }

    public function data($name, $values, $unique = false)
    {
        return $this->attr('data-'.$name, $values, $unique);
    }

    public function getContent()
    {
        if (count($this->childs) > 0) {
            return $this->makeChilds();
        }
        if (is_callable($this->content)) {
            return $this->$content($this);
        }
        return $this->content;
    }

    public function has($name, $value = null)
    {
        if (isset($this->attributes[$name])) {
            if ($value != null && in_array($value, $this->attributes[$name])) {
                return true;
            } elseif ($value == null) {
                return true;
            }
        }
        return false;
    }

    public function clearAttr($name)
    {
        $this->attributes[$name] = [];
    }

    public function clear($name)
    {
        if ($this->has($name)) {
            $this->clearAttr($name);
        } elseif (in_array($name, $this->booleanAttributes)) {
            $this->removeAttr($name);
        }
        return $this;
    }

    public function removeAttr($name)
    {
        if (in_array($name, $this->attributes)) {
            unset($this->attributes[$name]);
        } elseif (in_array($name, $this->booleanAttributes)) {
            unset($this->booleanAttributes[$name]);
        }
        return $this;
    }

    public function content($content, $append = false)
    {
        if (!is_callable($content) && $append) {
            $content = $this->content.$content;
        }
        $this->content = $content;
        return $this;
    }
}
