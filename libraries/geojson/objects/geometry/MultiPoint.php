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
     * @param array[]|Point $points
     *
     * @throws \geojson\exceptions\InvalidCoordinateFormatException
     */
    public function addPoints(array $points)
    {
        foreach ($points as $point) {
            $this->addPoint($point);
        }
    }


    /**
     * @param array|Point $coordinate An array structured as [longitude, latitude] or a Point
     *
     * @throws \InvalidArgumentException
     */
    public function addPoint($coordinate)
    {
        if ($coordinate instanceof Point) {
            $coordinate = $coordinate->getCoordinates();
        } elseif (!is_array($coordinate)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'The coordinate passed (type: %s) is not a valid type, must be either an array or a Point instance',
                    gettype($coordinate)
                )
            );
        }

        $this->coordinates[] = $coordinate;
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
