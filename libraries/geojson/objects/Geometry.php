<?php
namespace geojson\objects;

/**
 * Class Geometry
 *
 * @package geojson\objects
 */
abstract class Geometry extends BasicObject
{
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
    abstract public function getCoordinates();
}
