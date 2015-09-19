<?php
namespace geojson\objects\geometry;

use geojson\objects\Geometry;

/**
 * Class GeometryCollection
 * @package geojson\objects\geometry
 */
class GeometryCollection extends Geometry
{

    /**
     *
     */
    public function __construct()
    {
        $this->setType(self::TYPE_GEOMETRYCOLLECTION);
    }

    /**
     * @param Geometry $geometricObj
     *
     * @throws \InvalidArgumentException
     */
    public function add($geometricObj)
    {
        if (!($geometricObj instanceof Geometry)) {
            throw new \InvalidArgumentException('Only Geometry objects may be added to a GeometryCollection');
        }

        $this->addGeometry([$geometricObj]);
    }
}
