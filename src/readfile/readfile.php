<?php
namespace MyApp\ReadFile;
require_once ('vendor/autoload.php');

use MyApp\ApiData\ApiData;
use MyApp\CheckBase\CheckBase;
use MyApp\ExtractData\ExtractData;


class ReadFile{
    public function __construct(){

    }

    public function readFileData($argv) {
        try{
            $checkCon = $this->_checkConnection();
            if($checkCon == 'on'){
                if(isset($argv[1])){
                    foreach (explode("\n", file_get_contents($argv[1])) as $row) {
                        if(!empty($row)) {
                            //extract data from file
                            $value = ExtractData::extractRawData($row);
                            if(!empty($value)){
                                //call api for binresults
                                $binResults = ApiData::getBinData($value);
                                if (empty($binResults)){
                                    throw new \Exception('error');
                                } else{
                                    $r = json_decode($binResults);
                                    //check base
                                    $isEu = CheckBase::isEu($r->country->alpha2);
                                    //call api for rate
                                    $rate = ApiData::getRate($value);
                                    if(isset($value[1]) && $value[1]){
                                        $amntFixed = $this->_fixedAmount($value, $rate);
                                        echo $amntFixed * ($isEu == 'yes' ? 0.01 : 0.02);
                                    } else {
                                        throw new \Exception('No Amount found');
                                    }
                                    print "\n";
                                }
                            } else {
                                throw new \Exception('No data found');
                            }
                        } else {
                            throw new \Exception('No data found');
                            break;
                        }
                    }
                } else {
                    throw new \Exception('Please add file name.');
                }
            } else {
                throw new \Exception('No Internet connection');
            }
        } catch (\Exception $e){
            echo 'Message : ' . $e->getMessage();
        }
    }

    //return amount
    private function _fixedAmount($value, $rate){
        if ($rate) {
            if ($value[2] == 'EUR' or $rate == 0) {
                $amntFixed = $value[1];
            }
            if ($value[2] != 'EUR' or $rate > 0) {
                $amntFixed = $value[1] / $rate;
            }
        } else {
            $amntFixed = $value[1];
        }
        return $amntFixed;
    }

    private function _checkConnection(){
        if(!$sock = @fsockopen('www.google.com', 80)) {
            return 'off';
        } else {
            return 'on';
        }
    }
}
