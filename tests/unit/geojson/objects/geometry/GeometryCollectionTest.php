<?php
namespace unit_tests\geojson\objects\geometry;

use geojson\objects\geometry\GeometryCollection;

/**
 * Class GeometryCollectionTest
 *
 * @package unit_tests\geojson\objects\geometry
 */
class GeometryCollectionTest extends \tests\AbstractTest
{
    public function testAddingGeometricObjects()
    {
        $sut = new GeometryCollection();

        $point = $this->generatePoint();
        $sut->add($point);

        $polygon = $this->generatePolygon();
        $sut->add($polygon);

        $coordinates = [$point->getCoordinates(), $polygon->getCoordinates()];

        $this->assertEquals($coordinates, $sut->getCoordinates());

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
            'type'        => 'GeometryCollection',
            'coordinates' => $coordinates
        ];
    }
}
