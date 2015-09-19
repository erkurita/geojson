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
class LineStringTest extends \tests\AbstractTest
{
    use GeometricUtils;

    public function testSimpleLine()
    {
        $sut = new LineString([13.9, 10.3], new Point(14.2, 15));

        $coordinates = [[13.9, 10.3], [14.2, 15]];

        $this->assertEquals($coordinates, $sut->getCoordinates());

        /** GeoJson Interface */
        $this->assertEquals(json_encode($this->generateGeoJSON($coordinates)), json_encode($sut));
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

    /**
     * @dataProvider equalPointsDataProvider
     */
    public function testEqual($pointA, $pointB)
    {
        $this->assertTrue(LineString::equal($pointA, $pointB));
    }

    /**
     * @dataProvider notEqualPointsDataProvider
     */
    public function testNotEqual($pointA, $pointB)
    {
        $this->assertFalse(LineString::equal($pointA, $pointB));
    }

    public function testIntegerCoordinatesAreProcessedProperly()
    {
        $this->assertTrue(LineString::equal([1, 2], new Point(1, 2)));
    }

    /**
     * @return array
     */
    public function equalPointsDataProvider()
    {
        return [
            [new Point(3.3, 4.4), [3.3, 4.4]],
            [[5.5, 6.6], new Point(5.5, 6.6)],
        ];
    }

    /**
     * @return array
     */
    public function notEqualPointsDataProvider()
    {
        return [
            [[17.18, 19.20], new Point(21.22, 23.24)],
            [new Point(9.10, 11.12), [13.14, 15.16]],
        ];
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
