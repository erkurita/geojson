<?php

namespace unit_tests\geojson\objects\geometry;

use geojson\objects\geometry\MultiPoint;
use geojson\objects\geometry\Point;

/**
 * Class MultiPointTest
 *
 * @package unit_tests\geojson\objects\geometry
 */
class MultiPointTest extends \tests\AbstractTest
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidPoints()
    {
        $sut = new MultiPoint();
        $sut->add([43.5, 43.5]);
    }

    public function testGeoJsonInterface()
    {
        $sut = new MultiPoint();
        $sut->add([new Point(33.5, 30.3), [34.5, 31.3]]);

        $coordinates = [[33.5, 30.3], [34.5, 31.3]];

        /** GeoJson Interface */
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
            'type'        => 'MultiPoint',
            'coordinates' => $coordinates
        ];
    }
}
