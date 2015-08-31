<?php

namespace unit_tests\geojson\objects\geometry;

use geojson\objects\geometry\Point;

/**
 * Class PointTest
 */
class PointTest extends \PHPUnit_Framework_TestCase
{
    public function testBasicPoint()
    {
        $sut = new Point(10.5, 13.5);

        $this->assertEquals($this->generateGeoJSON(10.5, 13.5), $sut->toGeoJSON());
    }

    /**
     * @param $latitude
     * @param $longitude
     *
     * @return array
     */
    private function generateGeoJSON($latitude, $longitude)
    {
        return [
            'type' => 'Point',
            'coordinates' => [$longitude, $latitude]
        ];
    }
}
