<?php
namespace geojson\objects\geometry;

use geojson\interfaces\GeoJsonObject;
use geojson\interfaces\GeoJSONSerializable;
use geojson\objects\Geometry;

/**
 * Class Point
 *
 * @package geojson\objects\geometry
 */
class Point extends Geometry implements GeoJSONSerializable
{
    private $latitude;
    private $longitude;

    /**
     * @param float $longitude
     * @param float $latitude
     */
    public function __construct($longitude, $latitude)
    {
        $this->longitude = (float)$longitude;
        $this->latitude = (float)$latitude;

        $this->setType(GeoJsonObject::TYPE_POINT);
    }

    /**
     * @inheritdoc
     */
    public function getCoordinates()
    {
        return [$this->longitude, $this->latitude];
    }
}
