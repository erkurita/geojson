<?php
namespace geojson\traits;

use geojson\objects\Geometry;

/**
 * Class PointBag
 * @package geojson\traits
 */
trait GeometricBag
{
    private $container = [];

    /**
     * @return int
     */
    public function count()
    {
        return count($this->container);
    }

    /**
     * @return mixed
     */
    public function first()
    {

        return reset($this->container);
    }

    /**
     * @return mixed
     */
    public function last()
    {
        return end($this->container);
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->container;
    }

    /**
     * @param array[]|Geometry[] $objects
     *
     * @throws \InvalidArgumentException
     */
    public function add(array $objects)
    {
        foreach ($objects as $object) {
            $this->addPoint($object);
        }
    }

    /**
     * @param array|Geometry $coordinate A geometry
     *
     * @throws \InvalidArgumentException
     */
    private function addPoint($coordinate)
    {
        if ($coordinate instanceof Geometry) {
            $coordinate = $coordinate->getCoordinates();
        } elseif (!is_array($coordinate)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'The coordinate passed (type: %s) is not a valid type, must be either an array or a Geometry instance',
                    gettype($coordinate)
                )
            );
        }

        $this->container[] = $coordinate;
    }
}
