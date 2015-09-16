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
        $container = $this->getContainer();
        return count($container);
    }

    /**
     * @return mixed
     */
    public function first()
    {
        $container = $this->getContainer();
        return reset($container);
    }

    /**
     * @return mixed
     */
    public function last()
    {
        $container = $this->getContainer();
        return end($container);
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->getContainer();
    }
}
