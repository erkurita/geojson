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
        $sut->addPoint([13.5, 10.3]);
        $sut->addPoint([14.5, 11.3]);
        $sut->addPoint([15.5, 12.3]);

        $coordinates = [[13.5, 10.3], [14.5, 11.3], [15.5, 12.3]];

        $this->assertEquals($this->generateGeoJSON($coordinates), $sut->toGeoJSON());
    }

    public function testSimpleMultiPointWithPoints()
    {
        $sut = new MultiPoint();
        $sut->addPoint(new Point(13.5, 10.3));
        $sut->addPoint(new Point(14.5, 11.3));
        $sut->addPoint(new Point(15.5, 12.3));

        $coordinates = [[13.5, 10.3], [14.5, 11.3], [15.5, 12.3]];

        $this->assertEquals($this->generateGeoJSON($coordinates), $sut->toGeoJSON());
    }

    public function testSimpleMultiPoinsMixed()
    {
        $sut = new MultiPoint();
        $sut->addPoints([new Point(13.5, 10.3), [14.5, 11.3]]);

        $coordinates = [[13.5, 10.3], [14.5, 11.3]];

        $this->assertEquals($this->generateGeoJSON($coordinates), $sut->toGeoJSON());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidPoints()
    {
        $sut = new MultiPoint();
        $sut->addPoint(13.5, 13.5);
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
