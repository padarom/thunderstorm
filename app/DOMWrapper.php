<?php

namespace Padarom\Thunderstorm;

use DOMNode;

class DOMWrapper
{
    protected $dom;

    public function __construct(DOMNode $document)
    {
        $this->dom = $document;
    }

    public function raw()
    {
        return $this->dom;
    }

    public function getElements($tag)
    {
        $result = [];

        foreach ($this->dom->getElementsByTagName($tag) as $element) {
            $result[] = new self($element);
        }

        return $result;
    }

    public function getElementValue($tag, $default = null)
    {
        $element = $this->resolveTag($tag);
        if (!$element)
            return $default;

        return $element->textContent;
    }

    public function getElementAttribute($tag, $attribute, $default = null)
    {
        $element = $this->resolveTag($tag);
        if (!$element)
            return $default;

        $value = $element->getAttribute($attribute);
        if (!strlen($value))
            return $default;

        return $value;
    }

    public function getTag($tag)
    {
        $elements = $this->dom->getElementsByTagName($tag);
        if (!count($elements))
            return null;

        return $elements[0];
    }

    protected function resolveTag($tag)
    {
        if (is_object($tag) && is_a($tag, DOMNode::class)) {
            return $tag;
        }

        if (is_object($tag) && is_a($tag, self::class)) {
            return $tag->raw();
        }

        $element = $this->getTag($tag);
        return $element;
    }
}