<?php
namespace unit_tests\geojson\objects\geometry;

use geojson\objects\geometry\LineString;
use geojson\objects\geometry\MultiPolygon;
use geojson\objects\geometry\Point;
use geojson\objects\geometry\Polygon;

/**
 * Class MultiPolygonTest
 * @package unit_tests\geojson\objects\geometry
 */
class MultiPolygonTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        /**
         * We need this in order to bypass PHPUnit's handler and test for the real exception
         */
        set_error_handler(
            function () {
                return true;
            }
        );
    }

    public function tearDown()
    {
        restore_error_handler();
    }

    public function testPolygonAddition()
    {
        $polygon1 = new Polygon();

        $lineString1 = $this->generateNewLinearRing();
        $polygon1->add($lineString1);

        $polygon2 = new Polygon();

        $lineString2 = $this->generateNewLinearRing();
        $polygon2->add($lineString2);

        $sut = new MultiPolygon();

        $sut->add($polygon1);
        $sut->add($polygon2);

        $expectedCoordinates = [$polygon1->getCoordinates(), $polygon2->getCoordinates()];

        $this->assertEquals($expectedCoordinates, $sut->getCoordinates());
    }

    public function testInvalidMultiLineAddition()
    {
        if (version_compare(PHP_VERSION, '6', '>')) {
            $this->setExpectedException('\TypeError');
        } else {
            $this->setExpectedException('\InvalidArgumentException');
        }

        $sut = new MultiPolygon();
        $sut->add('test');
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
