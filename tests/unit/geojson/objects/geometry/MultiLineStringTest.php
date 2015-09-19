<?php
namespace unit_tests\geojson\objects\geometry;

use geojson\objects\geometry\LineString;
use geojson\objects\geometry\MultiLineString;
use geojson\objects\geometry\Point;
use tests\helpers\GeometricUtils;

/**
 * Class MultiLineStringTest
 * @package unit_tests\geojson\objects\geometry
 */
class MultiLineStringTest extends \PHPUnit_Framework_TestCase
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

    public function testMultiLineAddition()
    {
        $lineString = new LineString(new Point(1, 2), new Point(2, 3));

        $sut = new MultiLineString();
        $sut->add($lineString);

        $expected_coordinates = [[[1, 2], [2, 3]]];

        $this->assertEquals($expected_coordinates, $sut->getCoordinates());
    }

    public function testInvalidMultiLineAddition()
    {
        if (version_compare(PHP_VERSION, '6', '>')) {
            $this->setExpectedException('\TypeError');
        } else {
            $this->setExpectedException('\InvalidArgumentException');
        }

        $sut = new MultiLineString();
        $sut->add('test');
    }

    public function testGeoJsonInterface()
    {
        $lineString1 = $this->generateLineString();
        $lineString2 = $this->generateLineString(3);
        $sut    = new MultiLineString();
        $sut->add($lineString1);
        $sut->add($lineString2);

        $coordinates = [$lineString1->getCoordinates(), $lineString2->getCoordinates()];

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
            'type'        => 'MultiLineString',
            'coordinates' => $coordinates
        ];
    }
}
