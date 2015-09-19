<?php
namespace geojson\objects;

/**
 * Class Feature
 * @package geojson\objects
 */
class Feature extends BasicObject
{
    private $properties = [];

    /** @var Geometry|null  */
    private $geometry = null;

    /** @var string|null  */
    private $featureId = null;

    /**
     *
     */
    public function __construct()
    {
        $this->setType(self::TYPE_FEATURE);
    }

    /**
     * @inheritdoc
     */
    public function toGeoArray()
    {
        $result = parent::toGeoArray();

        $properties = $this->getProperties();
        if (empty($properties)) {
            $properties = new \stdClass();
        }

        $result['geometry'] = $this->geometryToGeoJson();
        $result['properties'] = $properties;

        $featureId = $this->getFeatureId();

        if (!is_null($featureId)) {
            $result['id'] = $featureId;
        }

        return $result;
    }

    /**
     * @return null|string
     */
    public function getFeatureId()
    {
        return $this->featureId;
    }

    /**
     * @param null|string $featureId
     */
    public function setFeatureId($featureId)
    {
        $this->featureId = $featureId;
    }

    /**
     * @return Geometry|null
     */
    public function getGeometry()
    {
        return $this->geometry;
    }

    /**
     * @param Geometry $object
     */
    public function setGeometry(Geometry $object)
    {
        $this->geometry = $object;
    }

    /**
     * @return \array[]|\geojson\interfaces\GeoJsonObject[]
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @param array $properties
     */
    public function setProperties(array $properties)
    {
        $this->properties = $properties;
    }

    /**
     * @param string $name
     * @param mixed  $value
     */
    public function addProperty($name, $value)
    {
        $this->properties[$name] = $value;
    }

    /**
     * @param string $name
     */
    public function removeProperty($name)
    {
        if ($this->hasProperty($name)) {
            unset($this->properties[$name]);
        }
    }

    /**
     * @param mixed $name
     *
     * @return bool
     */
    public function hasProperty($name)
    {
        return isset($this->properties[$name]);
    }

    /**
     * @return array|null
     */
    private function geometryToGeoJson()
    {
        $geometry = $this->getGeometry();

        if ($geometry instanceof Geometry) {
            return $geometry->toGeoArray();
        }

        return null;
    }
}
