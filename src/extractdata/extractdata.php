<?php
namespace MyApp\ExtractData;



class ExtractData
{
    public function __construct()
    {

    }

    //modified original logic
    public function extractRawData($row){
        $decoded_row = json_decode($row, true);
        if(!empty($decoded_row)){
            $value[0] = isset($decoded_row['bin']) ? $decoded_row['bin'] : '';
            $value[1] = isset($decoded_row['amount']) ? $decoded_row['amount'] : '';
            $value[2] = isset($decoded_row['currency']) ? $decoded_row['currency'] : '';
        } else {
            $value = [];
        }

//        $p = explode(",", $row);
//        $p2 = explode(':', $p[0]);
//        $value[0] = trim($p2[1], '"');
//        $p2 = explode(':', $p[1]);
//        $value[1] = trim($p2[1], '"');
//        $p2 = explode(':', $p[2]);
//        $value[2] = trim($p2[1], '"}');

        return $value;
    }

}
