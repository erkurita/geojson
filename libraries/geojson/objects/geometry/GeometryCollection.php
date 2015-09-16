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
