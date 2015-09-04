<?php

namespace geojson\objects\geometry;

use geojson\objects\Geometry;
use geojson\traits\GeometricBag;

/**
 * Class Polygon
 * @package geojson\objects\geometry
 */
class Polygon extends Geometry
{
    use GeometricBag {
       add as addGeometry;
    }

    const INVALID_ARGUMENT_CODE = 1;
    const NON_LINEARRING_CODE = 2;

    /**
     *
     */
    public function __construct()
    {
        $this->setType(self::TYPE_POLYGON);
    }

    /**
     * @param LineString $lineString
     *
     * @throws \InvalidArgumentException
     */
    public function add(LineString $lineString)
    {
        if (!($lineString instanceof LineString)) {
            throw new \InvalidArgumentException(
                'Only LineString objects may be added to a MultiLineString',
                self::INVALID_ARGUMENT_CODE
            );
        }

        if (!$lineString->isLinearRing()) {
            throw new \InvalidArgumentException(
                'The LineString instance passed is not a LinearRing (4 points, first and last must be equal)',
                self::NON_LINEARRING_CODE
            );
        }

        $this->addGeometry([$lineString]);
    }

    /**
     * Returns an array of coordinates
     *
     * @return array
     */
    public function getCoordinates()
    {
        return $this->all();
    }
}
