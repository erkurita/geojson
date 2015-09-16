<?php
namespace geojson\objects\geometry;

use geojson\objects\Geometry;
use geojson\traits\GeometricBag;


/**
 * Class GeometryCollection
 * @package geojson\objects\geometry
 */
class GeometryCollection extends Geometry
{
    use GeometricBag {
        add as addGeometry;
    }

    /**
     *
     */
    public function __construct()
    {
        $this->setType(self::TYPE_GEOMETRYCOLLECTION);
    }

    /**
     * @param Geometry $geometric_obj
     */
    public function add(Geometry $geometric_obj)
    {
        $this->addGeometry([$geometric_obj]);
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
