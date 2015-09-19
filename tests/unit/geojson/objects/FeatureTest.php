<?php
namespace unit_tests\geojson\objects;

use geojson\objects\Feature;
use geojson\objects\geometry\Point;

/**
 * Class FeatureTest
 *
 * @package unit_tests\geojson\objects
 */
class FeatureTest extends \tests\AbstractTest
{
    /** @var Feature */
    private $sut;

    public function setUp()
    {
        $this->sut = new Feature();

        $point = new Point(8.7, 6.9);

        $this->sut->setGeometry($point);
        $this->sut->addProperty('test', 'value');
    }

    public function testEmptyFeature()
    {
        $sut = new Feature();
        $sut->removeProperty('test');

        $expectedJson = <<<END
{"type":"Feature","geometry":null,"properties":{}}
END;

        $this->assertEquals($expectedJson, json_encode($sut));
    }

    public function testGeometryWithNoProperties()
    {
        $this->sut->removeProperty('test');
        $expectedJson = <<<END
{"type":"Feature","geometry":{"type":"Point","coordinates":[8.7,6.9]},"properties":{}}
END;

        $this->assertEquals($expectedJson, json_encode($this->sut));
    }

    public function testGeometryWithPropertiesAndId()
    {
        $this->sut->setFeatureId('test');
        $this->sut->setProperties(['testb' => 'testa']);

        $expectedJson = <<<END
{"type":"Feature","geometry":{"type":"Point","coordinates":[8.7,6.9]},"properties":{"testb":"testa"},"id":"test"}
END;

        $this->assertEquals($expectedJson, json_encode($this->sut));
    }
}
