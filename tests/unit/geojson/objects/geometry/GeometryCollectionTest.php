<?php
namespace unit_tests\geojson\objects\geometry;

use geojson\objects\geometry\GeometryCollection;
use geojson\objects\geometry\LineString;
use geojson\objects\geometry\Point;
use geojson\objects\geometry\Polygon;

/**
 * Class GeometryCollectionTest
 * @package unit_tests\geojson\objects\geometry
 */
class GeometryCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testAddingGeometricObjects()
    {
        $sut = new GeometryCollection();

        $point = new Point(12.3, 4.56);
        $sut->add($point);

        $polygon = $this->generatePolygon();

        $sut->add($polygon);

        $this->assertEquals([$point->getCoordinates(), $polygon->getCoordinates()], $sut->getCoordinates());
    }

    /**
     * @return Polygon
     */
    private function generatePolygon()
    {
        $polygon = new Polygon();

        $lineString = $this->generateNewLinearRing();
        $polygon->add($lineString);

        return $polygon;
    }

    /**
     * @return LineString
     */
    private function generateNewLinearRing()
    {
        $lineString = new LineString(
            $this->generateNewPoint(),
            $this->generateNewPoint()
        );

        $lineString->add([$this->generateNewPoint()]);

        $lineString->close();

        return $lineString;
    }

    /**
     * @return Point
     */
    private function generateNewPoint()
    {
        return new Point(rand(0, 20), rand(0, 20));
    }
}
