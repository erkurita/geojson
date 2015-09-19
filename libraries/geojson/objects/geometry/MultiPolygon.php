<?php

namespace geojson\objects\geometry;

use geojson\objects\Geometry;

/**
 * Class MultiPolygon
 * @package geojson\objects\geometry
 */
class MultiPolygon extends Geometry
{

    /**
     *
     */
    public function __construct()
    {
        $this->setType(self::TYPE_MULTIPOLYGON);
    }

    /**
     * @param Polygon $polygon
     *
     * @throws \InvalidArgumentException
     */
    public function add(Polygon $polygon)
    {
        if (!($polygon instanceof Polygon)) {
            throw new \InvalidArgumentException('Only Polygon objects may be added to a MultiPolygon');
        }

        $this->addGeometry([$polygon]);
    }

    /**
     * Returns an array of coordinates
     *
     * @return array
     */
    public function getCoordinates()
    {
        return $this->all();
    }
}
