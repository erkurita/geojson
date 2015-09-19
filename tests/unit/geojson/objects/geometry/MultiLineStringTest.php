<?php
namespace unit_tests\geojson\objects\geometry;

use geojson\objects\geometry\LineString;
use geojson\objects\geometry\MultiLineString;
use geojson\objects\geometry\Point;

/**
 * Class MultiLineStringTest
 *
 * @package unit_tests\geojson\objects\geometry
 */
class MultiLineStringTest extends \tests\AbstractTest
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

    public function testMultiLineAddition()
    {
        $lineString = new LineString(new Point(1, 2), new Point(2, 3));

        $sut = new MultiLineString();
        $sut->add($lineString);

        $expectedCoordinates = [[[1, 2], [2, 3]]];

        $this->assertEquals($expectedCoordinates, $sut->getCoordinates());

        /** GeoJson Interface */
        $this->assertEquals(json_encode($this->generateGeoJSON($expectedCoordinates)), json_encode($sut));
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
