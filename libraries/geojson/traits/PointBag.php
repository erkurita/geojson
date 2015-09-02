<?php

namespace geojson\traits;

use geojson\objects\geometry\Point;


/**
 * Class PointBag
 * @package geojson\traits
 */
trait PointBag
{
    private $coordinates = [];

    /**
     * @return int
     */
    public function count()
    {
        return count($this->coordinates);
    }

    /**
     * @return Point|array
     */
    public function first()
    {
        return reset($this->coordinates);
    }

    /**
     * @return Point|array
     */
    public function last()
    {
        return end($this->coordinates);
    }

    /**
     * @return Point[]|array[]
     */
    public function all()
    {
        return $this->coordinates;
    }

    /**
     * @param array[]|Point[] $points
     *
     * @throws \InvalidArgumentException
     */
    public function addPoints(array $points)
    {
        foreach ($points as $point) {
            $this->addPoint($point);
        }
    }


    /**
     * @param array|Point $coordinate An array structured as [longitude, latitude] or a Point
     *
     * @throws \InvalidArgumentException
     */
    public function addPoint($coordinate)
    {
        if ($coordinate instanceof Point) {
            $coordinate = $coordinate->getCoordinates();
        } elseif (!is_array($coordinate)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'The coordinate passed (type: %s) is not a valid type, must be either an array or a Point instance',
                    gettype($coordinate)
                )
            );
        }

        $this->coordinates[] = $coordinate;
    }
}
