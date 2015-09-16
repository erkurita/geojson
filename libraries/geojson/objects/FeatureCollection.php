<?php
namespace geojson\objects;

/**
 * Class FeatureCollection
 * @package geojson\objects
 */
class FeatureCollection extends BasicObject
{
    /** @var Feature[]  */
    private $features = [];

    /**
     *
     */
    public function __construct()
    {
        $this->setType(self::TYPE_FEATURECOLLECTION);
    }

    /**
     * @inheritdoc
     */
    public function toGeoJSON()
    {
        $result = parent::toGeoJSON();

        $result['features'] = $this->featuresToGeoJson();

        return $result;
    }

    /**
     * @param Feature $feature
     */
    public function addFeature(Feature $feature)
    {
        $this->features[] = $feature;
    }

    /**
     * @return array
     */
    private function featuresToGeoJson()
    {
        $result = [];

        foreach ($this->features as $feature) {
            $result[] = $feature->toGeoJSON();
        }

        return $result;
    }
}
