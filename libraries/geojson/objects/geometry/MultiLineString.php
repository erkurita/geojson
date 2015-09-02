<?php
namespace geojson\objects\geometry;

use geojson\objects\Geometry;
use geojson\traits\GeometricBag;

/**
 * Class MultiLineString
 * @package geojson\objects\geometry
 */
class MultiLineString extends Geometry
{
    use GeometricBag {
        add as addGeometry;
    }

    /**
     * @param LineString $lineString
     *
     * @throws \InvalidArgumentException
     */
    public function add(LineString $lineString)
    {
        if (!($lineString instanceof LineString)) {
            throw new \InvalidArgumentException('Only LineString objects may be added to a MultiLineString');
        }

        $this->addGeometry([$lineString]);
    }

    /**
     *
     */
    public function __construct()
    {
        $this->setType(self::TYPE_MULTILINESTRING);
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
