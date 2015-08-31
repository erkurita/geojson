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
     * The value of the type member must be one of:
     *   - Point
     *   - MultiPoint
     *   - LineString
     *   - MultiLineString
     *   - Polygon
     *   - MultiPolygon
     *   - GeometryCollection
     *   - Feature
     *   - FeatureCollection
     *
     * The case of the type member values must be as shown here.
     *
     * @see http://geojson.org/geojson-spec.html#geojson-objects
     * @return string
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
    abstract protected function isValidType($type);

    /**
     * @inheritdoc
     */
    public function toGeoJSON()
    {
        return ['type' => $this->getType()];
    }
}
