<?php
namespace geojson\objects\geometry;

use geojson\objects\Geometry;

/**
 * Class MultiLineString
 * @package geojson\objects\geometry
 */
class MultiLineString extends Geometry
{

    /**
     *
     */
    public function __construct()
    {
        $this->setType(self::TYPE_MULTILINESTRING);
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
     * Returns an array of coordinates
     *
     * @return array
     */
    public function getCoordinates()
    {
        return $this->all();
    }
}
