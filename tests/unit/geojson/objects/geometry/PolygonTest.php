<?php

namespace unit_tests\geojson\objects\geometry;

use geojson\objects\geometry\LineString;
use geojson\objects\geometry\Point;
use geojson\objects\geometry\Polygon;

/**
 * Class PolygonTest
 * @package unit_tests\geojson\objects\geometry
 */
class PolygonTest extends \PHPUnit_Framework_TestCase
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

    public function testLinearRingAddition()
    {
        $lineString = new LineString(new Point(1, 2), new Point(2, 3));
        $lineString->add([new Point(3, 4), new Point(4, 1)]);
        $lineString->close();

        $sut = new Polygon();
        $sut->add($lineString);

        $expected_coordinates = [[[1, 2], [2, 3], [3, 4], [4, 1], [1, 2]]];

        $this->assertEquals($expected_coordinates, $sut->getCoordinates());
    }

    public function testInvalidLinearRingAdditionArgument()
    {
        if (version_compare(PHP_VERSION, '6', '>')) {
            $this->setExpectedException('\TypeError');
        } else {
            $this->setExpectedException(
                '\InvalidArgumentException',
                '',
                Polygon::INVALID_ARGUMENT_CODE
            );
        }

        $sut = new Polygon();
        $sut->add('test');
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedCode \geojson\objects\geometry\Polygon::NON_LINEARRING_CODE
     */
    public function testNonLinearRingAddition()
    {
        $lineString = new LineString(new Point(1, 2), new Point(2, 3));

        $sut = new Polygon();
        $sut->add($lineString);
    }
}
