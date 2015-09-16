<?php
namespace geojson\traits;

use geojson\objects\Geometry;

/**
 * Class PointBag
 * @package geojson\traits
 */
trait GeometricBag
{
    use Bag;

    private $container = [];

    /**
     * @return Geometry[]|array[]
     */
    public function getContainer()
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
