<?php
namespace unit_tests\geojson\objects;

use geojson\objects\Feature;
use geojson\objects\FeatureCollection;
use geojson\objects\geometry\Point;

/**
 * Class FeatureCollectionTest
 *
 * @package unit_tests\geojson\objects
 */
class FeatureCollectionTest extends \tests\AbstractTest
{
    /** @var FeatureCollection */
    private $sut;

    public function setUp()
    {
        $this->sut = new FeatureCollection();
    }

    public function testEmptyCollection()
    {
        $expectedJson = <<<END
{"type":"FeatureCollection","features":[]}
END;

        $this->assertEquals($expectedJson, json_encode($this->sut));
    }

    public function testSingleFeature()
    {
        $point = new Point(8.7, 6.9);
        $feature = new Feature();

        $feature->setGeometry($point);
        $this->sut->addFeature($feature);

        $expectedJson = <<<END
{"type":"FeatureCollection","features":[{"type":"Feature","geometry":{"type":"Point","coordinates":[8.7,6.9]},"properties":{}}]}
END;

        $this->assertEquals($expectedJson, json_encode($this->sut));
    }
}
