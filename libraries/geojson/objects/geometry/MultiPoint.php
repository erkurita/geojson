<?php

namespace geojson\objects\geometry;

use geojson\interfaces\GeoJsonObject;
use geojson\interfaces\GeoJSONSerializable;
use geojson\objects\Geometry;


/**
 * Class MultiPoint
 * @package geojson\objects\geometry
 */
class MultiPoint extends Geometry implements GeoJSONSerializable
{
    private $coordinates = [];

    /**
     *
     */
    public function __construct()
    {
        $this->setType(GeoJsonObject::TYPE_MULTIPOINT);
    }

    /**
     * @param float $latitude
     * @param float $longitude
     */
    public function addPoint($latitude, $longitude)
    {
        $this->coordinates[] = [$longitude, $latitude];
    }

    /**
     * Returns an array of coordinates
     *
     * @return array
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }
}
