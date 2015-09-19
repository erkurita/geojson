<?php

namespace unit_tests\geojson\objects\geometry;

use geojson\objects\geometry\Point;

/**
 * Class PointTest
 *
 * @package unit_tests\geojson\objects\geometry
 */
class PointTest extends \tests\AbstractTest
{
    public function testBasicPoint()
    {
        $sut = new Point(13.5, 10.5);

        $this->assertEquals(json_encode($this->generateGeoJSON(13.5, 10.5)), json_encode($sut));
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
            'type'        => 'Point',
            'coordinates' => [$longitude, $latitude]
        ];
    }
}
