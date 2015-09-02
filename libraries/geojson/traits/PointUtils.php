<?php

namespace geojson\traits;

use geojson\objects\geometry\Point;


/**
 * Class PointUtils
 * @package geojson\traits
 */
trait PointUtils
{
    /**
     * @param Point|array $pointA
     * @param Point|array $pointB
     *
     * @return bool
     */
    public function equal($pointA, $pointB)
    {
        if ($pointA instanceof Point) {
            $pointA = $pointA->getCoordinates();
        } else {
            array_walk($pointA, function (&$value) {$value = (float)$value;});
        }

        if ($pointB instanceof Point) {
            $pointB = $pointB->getCoordinates();
        } else {
            array_walk($pointB, function (&$value) {$value = (float)$value; });
        }

        return $pointA === $pointB;
    }
}
