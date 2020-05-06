<?php
use MyApp\ApiData\ApiData;

class ExampleTest extends \PHPUNIT_Framework_TestCase{


    public function testGetBinData($value){
        $value[0] = "45717360";
        $this->assertTrue($value);
    }


    public function provider()
    {
        $value[0] = "45717360";
        return $value;
    }
}
