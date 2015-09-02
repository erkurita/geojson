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
            [new Point(1.1, 2.2), [1.1, 2.2]],
            [[1.1, 2.2], new Point(1.1, 2.2)],
            [new Point(1.1, 2.2), new Point(1.1, 2.2)],
        ];
    }

    /**
     * @return array
     */
    public function notEqualPointsDataProvider()
    {
        return [
            [[1.2, 2.2], [4.2, 2.2]],
            [new Point(1.2, 2.2), [4.2, 2.2]],
            [[1.2, 2.2], new Point(4.2, 2.2)],
            [new Point(1.2, 2.2), new Point(4.2, 2.2)],
        ];
    }
}
