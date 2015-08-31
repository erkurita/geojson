<?php
namespace geojson\interfaces;

/**
 * Interface GeoJsonObject
 *
 * @package geojson\interfaces
 */
interface GeoJsonObject
{
    const TYPE_POINT              = 'Point';
    const TYPE_MULTIPOINT         = 'MultiPoint';
    const TYPE_LINESTRING         = 'LineString';
    const TYPE_MULTILINESTRING    = 'MultiLineString';
    const TYPE_POLYGON            = 'Polygon';
    const TYPE_MULTIPOLYGON       = 'MultiPolygon';
    const TYPE_GEOMETRYCOLLECTION = 'GeometryCollection';
    const TYPE_FEATURE            = 'Feature';
    const TYPE_FEATURECOLLECTION  = 'FeatureCollection';

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
    public function getType();
}
