<?php
namespace unit_tests\geojson\objects\geometry;

use geojson\objects\geometry\MultiPolygon;
use tests\helpers\GeometricUtils;

/**
 * Class MultiPolygonTest
 * @package unit_tests\geojson\objects\geometry
 */
class MultiPolygonTest extends \PHPUnit_Framework_TestCase
{
    use GeometricUtils;

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
    }

    public function testInvalidMultiLineAddition()
    {
        if (version_compare(PHP_VERSION, '6', '>')) {
            $this->setExpectedException('\TypeError');
        } else {
            $this->setExpectedException('\InvalidArgumentException');
        }

        $sut = new MultiPolygon();
        $sut->add('test');
    }

    public function testGeoJsonInterface()
    {
        $polygon1 = $this->generatePolygon();
        $polygon2 = $this->generatePolygon();

        $sut = new MultiPolygon();

        $sut->add($polygon1);
        $sut->add($polygon2);

        $coordinates = [$polygon1->getCoordinates(), $polygon2->getCoordinates()];

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
            'type'        => 'MultiPolygon',
            'coordinates' => $coordinates
        ];
    }
}
