<?php
namespace geojson\objects;

use geojson\traits\GeometricBag;

/**
 * Class Geometry
 *
 * @package geojson\objects
 */
abstract class Geometry extends BasicObject
{
    use GeometricBag;

    /**
     * @inheritdoc
     */
    final protected function isValidType($type)
    {
        return in_array(
            $type,
            [
                self::TYPE_POINT,
                self::TYPE_MULTIPOINT,
                self::TYPE_LINESTRING,
                self::TYPE_MULTILINESTRING,
                self::TYPE_POLYGON,
                self::TYPE_MULTIPOLYGON,
                self::TYPE_GEOMETRYCOLLECTION
            ]
        );
    }

    /**
     * @param array[]|Geometry[] $objects
     *
     * @throws \InvalidArgumentException
     */
    public function add($objects)
    {
        $this->addGeometry($objects);
    }

    /**
     * @inheritdoc
     */
    public function toGeoArray()
    {
        $result = parent::toGeoArray();
        $result['coordinates'] = $this->getCoordinates();

        return $result;
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
