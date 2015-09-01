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
        $sut = new Point(13.5, 10.5);

        $this->assertEquals($this->generateGeoJSON(13.5, 10.5), $sut->toGeoJSON());
    }

    /**
     * @param float $longitude
     * @param float $latitude
     *
     * @return array
     */
    private function generateGeoJSON($longitude, $latitude)
    {
        return [
            'type' => 'Point',
            'coordinates' => [$longitude, $latitude]
        ];
    }
}
