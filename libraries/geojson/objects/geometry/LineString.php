<?php

namespace geojson\objects\geometry;

use geojson\interfaces\GeoJsonObject;
use geojson\objects\Geometry;
use geojson\traits\GeometricBag;
use geojson\traits\PointUtils;


/**
 * Class LineString
 * @package geojson\objects\geometry
 */
class LineString extends Geometry
{
    use GeometricBag;
    use PointUtils;

    /**
     * @param Point|array $pointA
     * @param Point|array $pointB
     */
    public function __construct($pointA, $pointB)
    {
        $this->add([$pointA, $pointB]);

        $this->setType(GeoJsonObject::TYPE_LINESTRING);
    }

    public function close()
    {
        $this->addPoint($this->first());
    }

    /**
     * @return bool
     */
    public function isLinearRing()
    {
        return $this->count() >= 4
           && $this->equal($this->first(), $this->last());
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
