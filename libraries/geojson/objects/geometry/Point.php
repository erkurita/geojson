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
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct($latitude, $longitude)
    {
        $this->latitude = (float)$latitude;
        $this->longitude = (float)$longitude;

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
