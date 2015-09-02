<?php
namespace unit_tests\geojson\objects\geometry;

use geojson\objects\geometry\LineString;
use geojson\objects\geometry\MultiLineString;
use geojson\objects\geometry\Point;

/**
 * Class MultiLineStringTest
 * @package unit_tests\geojson\objects\geometry
 */
class MultiLineStringTest extends \PHPUnit_Framework_TestCase
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

        $expected_coordinates = [[[1, 2], [2, 3]]];

        $this->assertEquals($expected_coordinates, $sut->getCoordinates());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidMultiLineAddition()
    {
        $sut = new MultiLineString();
        $sut->add('test');
    }
}
