<?php

namespace geojson\objects\geometry;

use geojson\interfaces\GeoJsonObject;
use geojson\interfaces\GeoJSONSerializable;
use geojson\objects\Geometry;

/**
 * Class MultiPoint
 * @package geojson\objects\geometry
 */
class MultiPoint extends Geometry implements GeoJSONSerializable
{
    /**
     *
     */
    public function __construct()
    {
        $this->setType(GeoJsonObject::TYPE_MULTIPOINT);
    }
}
