<?php
namespace tests\helpers;

use geojson\objects\geometry\LineString;
use geojson\objects\geometry\Point;
use geojson\objects\geometry\Polygon;

/**
 * Trait GeometricUtils
 *
 * @package tests\helpers
 */
trait GeometricUtils
{

    /**
     * @return Polygon
     */
    public function generatePolygon()
    {
        $polygon = new Polygon();

        $lineString = $this->generateLinearRing();
        $polygon->add($lineString);

        return $polygon;
    }

    /**
     * @return LineString
     */
    public function generateLinearRing()
    {
        $lineString = $this->generateLineString(3);

        $lineString->close();

        return $lineString;
    }

    /**
     * @param int $numPoints
     *
     * @return LineString
     */
    public function generateLineString($numPoints = 2)
    {
        $lineString = new LineString(
            $this->generatePoint(),
            $this->generatePoint()
        );

        for ($i = 2; $i < $numPoints; $i++) {
            $lineString->add([$this->generatePoint()]);
        }

        return $lineString;
    }

    /**
     * @return Point
     */
    public function generatePoint()
    {
        return new Point(rand(0, 20), rand(0, 20));
    }
}
