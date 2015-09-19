<?php
namespace geojson\objects;

use geojson\exceptions\InvalidTypeException;
use geojson\interfaces\GeoJsonObject;
use geojson\interfaces\GeoJSONSerializable;

/**
 * Class BasicObject
 *
 * @package geojson\objects
 */
abstract class BasicObject implements GeoJsonObject, GeoJSONSerializable
{
    private $type = null;

    /**
     * @inheritdoc
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @throws \geojson\exceptions\InvalidTypeException
     *
     * @return $this
     */
    final protected function setType($type)
    {
        if (is_string($type) && $this->isValidType($type)) {
            $this->type = $type;
        } else {
            throw new InvalidTypeException(
                sprintf('The type "%s" is not a valid GeoJSON type', $type)
            );
        }

        return $this;
    }

    /**
     * @param string $type
     *
     * @return bool
     */
    protected function isValidType($type)
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
                self::TYPE_GEOMETRYCOLLECTION,
                self::TYPE_FEATURE,
                self::TYPE_FEATURECOLLECTION,
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function toGeoArray()
    {
        return ['type' => $this->getType()];
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        return $this->toGeoArray();
    }
}
