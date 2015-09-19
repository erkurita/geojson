<?php
namespace unit_tests\geojson\objects\geometry;

use geojson\objects\geometry\MultiPolygon;

/**
 * Class MultiPolygonTest
 * @package unit_tests\geojson\objects\geometry
 */
class MultiPolygonTest extends \tests\AbstractTest
{
    public function setUp()
    {
        /**
         * We need this in order to bypass PHPUnit's handler and test for the real exception
         */
        set_error_handler(
            function () {
                return true;
            }
        );
    }

    public function tearDown()
    {
        restore_error_handler();
    }

    public function testPolygonAddition()
    {
        $polygon1 = $this->generatePolygon();
        $polygon2 = $this->generatePolygon();

        $sut = new MultiPolygon();

        $sut->add($polygon1);
        $sut->add($polygon2);

        $expectedCoordinates = [$polygon1->getCoordinates(), $polygon2->getCoordinates()];

        $this->assertEquals($expectedCoordinates, $sut->getCoordinates());

        /** GeoJson Interface */
        $this->assertEquals(json_encode($this->generateGeoJSON($expectedCoordinates)), json_encode($sut));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidMultiLineAddition()
    {
        $sut = new MultiPolygon();
        $sut->add('test');
    }

    /**
     * @param array $coordinates
     *
     * @return array
     */
    private function generateGeoJSON(array $coordinates)
    {
        return [
            'type'        => 'MultiPolygon',
            'coordinates' => $coordinates
        ];
    }
}
