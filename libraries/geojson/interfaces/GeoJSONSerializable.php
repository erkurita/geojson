<?php
namespace geojson\interfaces;

/**
 * Interface GeoJSONSerializable
 */
interface GeoJSONSerializable extends \JsonSerializable
{
    /**
     * Returns a JSON-serializable array
     *
     * @return array
     */
    public function toGeoArray();
}
