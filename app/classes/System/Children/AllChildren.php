<?php namespace System\Children;

/**
 * Class AllChildren
 * @package System\Children
 */
class AllChildren
{
    private $children = [];

    public function get() :array
    {
        return $this->children;
    }

    public function add(array $children): void
    {
        $this->children = $children;
    }
}