<?php

namespace geojson\traits;

/**
 * Trait Bag
 * @package geojson\traits
 */
trait Bag
{
    /**
     * @return mixed
     */
    abstract public function getContainer();

    /**
     * @return int
     */
    public function count()
    {
        return count($this->getContainer());
    }

    /**
     * @return mixed
     */
    public function first()
    {
        return reset($this->getContainer());
    }

    /**
     * @return mixed
     */
    public function last()
    {
        return end($this->getContainer());
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->getContainer();
    }
}
