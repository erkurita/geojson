<?php

namespace geojson\objects\geometry;

use geojson\interfaces\GeoJsonObject;
use geojson\objects\Geometry;

/**
 * Class LineString
 *
 * @package geojson\objects\geometry
 */
class LineString extends Geometry
{
    /**
     * @param Point|array $pointA
     * @param Point|array $pointB
     */
    public function __construct($pointA, $pointB)
    {
        $this->addGeometry([$pointA, $pointB]);

        $this->setType(GeoJsonObject::TYPE_LINESTRING);
    }

    public function close()
    {
        $this->addGeometry([$this->first()]);
    }

    /**
     * @return bool
     */
    public function isLinearRing()
    {
        return $this->count() >= 4
           && self::equal($this->first(), $this->last());
    }

    /**
     * @param Point|array $pointA
     * @param Point|array $pointB
     *
     * @return bool
     */
    public static function equal($pointA, $pointB)
    {
        if ($pointA instanceof Point) {
            $pointA = $pointA->getCoordinates();
        } else {
            array_walk(
                $pointA,
                function (&$value) {
                    $value = (float)$value;
                }
            );
        }

        if ($pointB instanceof Point) {
            $pointB = $pointB->getCoordinates();
        } else {
            array_walk(
                $pointB,
                function (&$value) {
                    $value = (float)$value;
                }
            );
        }

        return $pointA === $pointB;
    }
}
