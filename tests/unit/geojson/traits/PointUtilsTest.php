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
            [[1.1, 2.2], [1.1, 2.2]],
            [new Point(3.3, 4.4), [3.3, 4.4]],
            [[5.5, 6.6], new Point(5.5, 6.6)],
            [new Point(7.7, 8.8), new Point(7.7, 8.8)],
        ];
    }

    /**
     * @return array
     */
    public function notEqualPointsDataProvider()
    {
        return [
            [[1.2, 3.4], [5.6, 7.8]],
            [new Point(9.10, 11.12), [13.14, 15.16]],
            [[17.18, 19.20], new Point(21.22, 23.24)],
            [new Point(25.26, 27.28), new Point(29.30, 31.32)],
        ];
    }
}
