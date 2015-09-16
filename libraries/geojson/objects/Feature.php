<?php
namespace geojson\objects;

use geojson\traits\PropertyBag;


/**
 * Class Feature
 * @package geojson\objects
 */
class Feature extends BasicObject
{
    use PropertyBag {
        add as addProperty;
        all as allProperties;
    }

    /** @var Geometry|null  */
    private $geometry = null;

    /**  */
    public function __construct()
    {
        $this->setType(self::TYPE_FEATURE);
    }

    /**
     * @param Geometry $object
     */
    public function set(Geometry $object)
    {
        $this->geometry = $object;
    }

    /**
     * @return \array[]|\geojson\interfaces\GeoJsonObject[]
     */
    public function getProperties()
    {
        return $this->allProperties();
    }

    /**
     * @inheritdoc
     */
    public function toGeoJSON()
    {
        $result = parent::toGeoJSON();

        $properties = $this->getProperties();
        if (empty($properties)) {
            $properties = new \stdClass();
        }

        $result['properties'] = $properties;
        $result['geometry'] = $this->geometryToGeoJson();

        return $result;
    }

    /**
     * @return array|null
     */
    private function geometryToGeoJson()
    {
        if ($this->geometry instanceof Geometry) {
            return $this->geometry->toGeoJSON();
        }

        return null;
    }
}
