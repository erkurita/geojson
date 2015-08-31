<?php

namespace unit_tests\geojson\objects\geometry;

use geojson\objects\geometry\MultiPoint;


/**
 * Class MultiPointTest
 * @package unit_tests\geojson\objects\geometry
 */
class MultiPointTest extends \PHPUnit_Framework_TestCase
{
    public function testSimpleMultiPoint()
    {
        $sut = new MultiPoint();
        $sut->addPoint(10.3, 13.5);
        $sut->addPoint(11.3, 14.5);
        $sut->addPoint(12.3, 15.5);

        $coordinates = [[13.5, 10.3], [14.5, 11.3], [15.5, 12.3]];

        $this->assertEquals($this->generateGeoJSON($coordinates), $sut->toGeoJSON());
    }

    /**
     * @param $latitude
     * @param $longitude
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
