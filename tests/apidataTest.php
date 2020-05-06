<?php
use MyApp\ApiData\ApiData;
use PHPUnit_Framework_ExpectationFailedException as PHPUnitException;

class apidataTest extends \PHPUNIT_Framework_TestCase{


    public function testGetBinData(){
        try {
            // something here
            $value[] = "";//"45717360";
            $data = $this->assertTrue(true);
            return $data;
        } catch (\SpecificException $e) {
            // force a fail:
            throw new \PHPUnitException("This was not expected.");
        }

    }

    public function testGetRate(){
        try {
            $value[2] = "EUR";
            $this->assertTrue(False);
        } catch (\SpecificException $e) {
            // force a fail:
            throw new \PHPUnitException("This was not expected.");
        }
    }

}
