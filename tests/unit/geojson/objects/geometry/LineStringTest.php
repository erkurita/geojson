<?php
namespace unit_tests\geojson\objects\geometry;

use geojson\objects\geometry\LineString;
use geojson\objects\geometry\Point;
use tests\helpers\GeometricUtils;

/**
 * Class LineStringTest
 *
 * @package unit_tests\geojson\objects\geometry
 */
class LineStringTest extends \PHPUnit_Framework_TestCase
{
    use GeometricUtils;

    public function testSimpleLine()
    {
        $sut = new LineString([13.9, 10.3], new Point(14.2, 15));

        $coordinates = [[13.9, 10.3], [14.2, 15]];

        $this->assertEquals($coordinates, $sut->getCoordinates());
    }

    /**
     * @return array
     */
    public function invalidLinearRingDataProvider()
    {
        return [
            /** A LinearRing must have 4 or more elements */
            [
                [[13.9, 10.3], [14.2, 15]]
            ],
            [
                [[13.9, 10.3], [14.2, 15]], [[13.9, 10.3]]
            ],
            /** The first and the last element must be equal */
            [
                [[13.9, 10.3], [14.2, 15]], [[15.2, 12], [35.2, 12]]
            ],
            [
                [[13.9, 10.3], [14.2, 15]], [[15.2, 12], [35.2, 12], [25.2, 15]]
            ],
        ];
    }

    /**
     * @dataProvider invalidLinearRingDataProvider
     */
    public function testLineIsNotALinearRing($basePoints, $additionalPoints = [])
    {
        $sut = new LineString($basePoints[0], $basePoints[1]);
        $sut->add($additionalPoints);

        $this->assertFalse($sut->isLinearRing());
    }

    public function testLineIsALinearRing()
    {
        $sut = new LineString(new Point(13.9, 10.3), [14.2, 15]);
        $sut->add([[15.2, 12], [35.2, 12], new Point(13.9, 10.3)]);

        $this->assertTrue($sut->isLinearRing());
    }

    public function testLineIsALinearRingWhenClosed()
    {
        $sut = $this->generateLineString(4);

        $this->assertFalse(
            $sut->isLinearRing(),
            'The ring was closed with invalid start and end coordinates'
        );

        $sut->close();

        $this->assertTrue(
            $sut->isLinearRing(),
            'The first and last coordinates must be equal for a LineString to be closed'
        );
    }

    public function testGeoJsonInterface()
    {
        $point1 = $this->generatePoint();
        $point2 = $this->generatePoint();
        $sut = new LineString($point1, $point2);

        $coordinates = [$point1->getCoordinates(), $point2->getCoordinates()];

        $this->assertEquals(json_encode($this->generateGeoJSON($coordinates)), json_encode($sut));
    }

    /**
     * @param array $coordinates
     *
     * @return array
     */
    private function generateGeoJSON(array $coordinates)
    {
        return [
            'type'        => 'LineString',
            'coordinates' => $coordinates
        ];
    }
}
