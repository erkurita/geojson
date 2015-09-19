<?php
namespace unit_tests\geojson\objects\geometry;

use geojson\objects\geometry\GeometryCollection;
use tests\helpers\GeometricUtils;

/**
 * Class GeometryCollectionTest
 *
 * @package unit_tests\geojson\objects\geometry
 */
class GeometryCollectionTest extends \PHPUnit_Framework_TestCase
{
    use GeometricUtils;

    public function testAddingGeometricObjects()
    {
        $sut = new GeometryCollection();

        $point = $this->generatePoint();
        $sut->add($point);

        $polygon = $this->generatePolygon();
        $sut->add($polygon);

        $this->assertEquals([$point->getCoordinates(), $polygon->getCoordinates()], $sut->getCoordinates());
    }

    public function testGeoJsonInterface()
    {
        $lineString = $this->generateLineString();
        $linearRing = $this->generateLinearRing();
        $sut    = new GeometryCollection();
        $sut->add($lineString);
        $sut->add($linearRing);

        $coordinates = [$lineString->getCoordinates(), $linearRing->getCoordinates()];

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
