<?php

namespace Padarom\UpdateServer;

use DOMDocument;

class DOMWrapper
{
    protected $dom;

    public function __construct(DOMDocument $document)
    {
        $this->dom = $document;
    }

    public function getElementValue($tag, $default = null)
    {
        $element = $this->getTag($tag);
        if (!$element)
            return $default;

        return $element->textContent;
    }

    public function getTag($tag)
    {
        $elements = $this->dom->getElementsByTagName($tag);
        if (!count($elements))
            return null;

        return $elements[0];
    }

    public function getElementAttribute($tag, $attribute, $default = null)
    {
        $element = $this->getTag($tag);
        if (!$element)
            return $default;

        $value = $element->getAttribute($attribute);
        if (!strlen($value))
            return $default;

        return $value;
    }
}