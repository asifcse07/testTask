<?php
namespace MyApp\ApiData;



class ApiData
{
    public function __construct()
    {

    }

    public function getBinData($value){
        try{
            if(isset($value[0]) && $value[0]){
                $binResults = file_get_contents('https://lookup.binlist.net/' . $value[0]);
                return $binResults;
            } else {
                throw new \Exception('No Bin data found');
            }
        } catch (\Exception $e){
            echo $e->getMessage();
        }
    }

    public function getRate($value){
        try{
            if(isset($value[2]) && $value[2]){
                $rate = @json_decode(file_get_contents('https://api.exchangeratesapi.io/latest'), true)['rates'][$value[2]];
                return $rate;
            } else {
                throw new \Exception('No rate data found');
            }
        } catch (\Exception $e){
            echo $e->getMessage();
        }
    }

}
