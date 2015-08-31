<?php

namespace unit_tests\geojson\objects;

use geojson\exceptions\InvalidTypeException;
use geojson\objects\BasicObject;


/**
 * Class BasicObjectTest
 * @package unit_tests\geojson\objects
 */
class BasicObjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var BasicObjectTestImplementation
     */
    private $sut;

    public function setUp()
    {
        $this->sut = new BasicObjectTestImplementation();
    }

    /**
     * @expectedException \geojson\exceptions\InvalidTypeException
     */
    public function testExceptionIsThrownWithInvalidTypes()
    {
        $this->sut->doSetType('test');
    }
}

/**
 * Class BasicObjectTestImplementation
 *
 * @package unit_tests\geojson\objects
 * @codeCoverageIgnore
 */
class BasicObjectTestImplementation extends BasicObject
{
    private $valid_type = false;

    /**
     * @param string $type
     */
    public function doSetType($type)
    {
        $this->setType($type);
    }

    /**
     * @param array $valid_type
     *
     * @return self
     */
    public function setIsValidType($valid_type)
    {
        $this->valid_type = (bool)$valid_type;

        return $this;
    }

    /**
     * @param string $type
     *
     * @return bool
     */
    protected function isValidType($type)
    {
        return $this->valid_type;
    }
}
