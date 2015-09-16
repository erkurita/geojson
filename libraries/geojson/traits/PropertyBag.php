<?php
namespace geojson\traits;

/**
 * Trait PropertyBag
 * @package geojson\traits
 */
trait PropertyBag
{
    use Bag;

    private $container = [];

    /**
     * @inheritdoc
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param string $name
     * @param mixed  $value
     */
    public function add($name, $value)
    {
        $this->container[$name] = $value;
    }

    /**
     * @param string $name
     */
    public function remove($name)
    {
        if ($this->has($name)) {
            unset($this->container[$name]);
        }
    }

    /**
     * @param mixed $name
     *
     * @return bool
     */
    public function has($name)
    {
        return isset($this->container[$name]);
    }
}
