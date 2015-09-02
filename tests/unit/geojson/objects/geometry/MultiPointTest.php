<?php

namespace unit_tests\geojson\objects\geometry;

use geojson\objects\geometry\MultiPoint;
use geojson\objects\geometry\Point;

/**
 * Class MultiPointTest
 * @package unit_tests\geojson\objects\geometry
 */
class MultiPointTest extends \PHPUnit_Framework_TestCase
{
    public function testSimpleMultiPointWithArrays()
    {
        $sut = new MultiPoint();
        $sut->add([[13.5, 10.3], [14.5, 11.3], [15.5, 12.3]]);

        $coordinates = [[13.5, 10.3], [14.5, 11.3], [15.5, 12.3]];

        $this->assertEquals($this->generateGeoJSON($coordinates), $sut->toGeoJSON());
    }

    public function testSimpleMultiPointWithPoints()
    {
        $sut = new MultiPoint();
        $sut->add([new Point(24.5, 20.3), new Point(25.5, 21.3), new Point(26.5, 22.3)]);

        $coordinates = [[24.5, 20.3], [25.5, 21.3], [26.5, 22.3]];

        $this->assertEquals($this->generateGeoJSON($coordinates), $sut->toGeoJSON());
    }

    public function testSimpleMultiPoinsMixed()
    {
        $sut = new MultiPoint();
        $sut->add([new Point(33.5, 10.3), [34.5, 31.3]]);

        $coordinates = [[33.5, 30.3], [34.5, 31.3]];

        $this->assertEquals($this->generateGeoJSON($coordinates), $sut->toGeoJSON());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidPoints()
    {
        $sut = new MultiPoint();
        $sut->add([43.5, 43.5]);
    }

    /**
     * @param array $coordinates
     *
     * @return array
     */
    private function generateGeoJSON(array $coordinates)
    {
        return [
            'type'        => 'MultiPoint',
            'coordinates' => $coordinates
        ];
    }
}
