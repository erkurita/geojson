<?php

namespace unit_tests\geojson\traits;

use geojson\objects\geometry\Point;
use geojson\traits\PointUtils;


/**
 * Class PointUtilsTest
 * @package unit_tests\geojson\traits
 */
class PointUtilsTest extends \PHPUnit_Framework_TestCase
{
    use PointUtils;

    /**
     * @dataProvider equalPointsDataProvider
     */
    public function testEqual($pointA, $pointB)
    {
        $this->assertTrue($this->equal($pointA, $pointB));
    }
    /**
     * @dataProvider notEqualPointsDataProvider
     */
    public function testNotEqual($pointA, $pointB)
    {
        $this->assertFalse($this->equal($pointA, $pointB));
    }

    public function testIntegerCoordinatesAreProcessedProperly()
    {
        $this->assertTrue($this->equal([1, 2], new Point(1, 2)));
    }

    /**
     * @return array
     */
    public function equalPointsDataProvider()
    {
        return [
            [new Point(3.3, 4.4), [3.3, 4.4]],
            [[5.5, 6.6], new Point(5.5, 6.6)],
        ];
    }

    /**
     * @return array
     */
    public function notEqualPointsDataProvider()
    {
        return [
            [[17.18, 19.20], new Point(21.22, 23.24)],
            [new Point(9.10, 11.12), [13.14, 15.16]],
        ];
    }
}
