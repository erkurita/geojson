<?php

namespace geojson\objects\geometry;

use geojson\interfaces\GeoJsonObject;
use geojson\interfaces\GeoJSONSerializable;
use geojson\objects\Geometry;
use geojson\traits\PointBag;

/**
 * Class MultiPoint
 * @package geojson\objects\geometry
 */
class MultiPoint extends Geometry implements GeoJSONSerializable
{
    use PointBag;

    /**
     *
     */
    public function __construct()
    {
        $this->setType(GeoJsonObject::TYPE_MULTIPOINT);
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
