<?php
namespace geojson\interfaces;

/**
 * Interface GeoJSONSerializable
 */
interface GeoJSONSerializable
{
    /**
     * Returns a JSON-serializable array
     *
     * @return array
     */
    public function toGeoJSON();
}
