<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NovaPoshtaApi extends Model
{
    public $apiKey     = '7308cf8ce134a329a969f0058701b25c';
    public $entryPoint = 'https://api.novaposhta.ua/v2.0/json/';

    public function getRegions()
    {
        return $this->requestToAPI('getAreas');
    }

    public function getCities()
    {
        return $this->requestToAPI('getCities');
    }

    private function requestToAPI($method, $model = 'Address')
    {
        $params = array(
            'modelName'    => $model,
            'calledMethod' => $method,
            'apiKey'       => $this->apiKey
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->entryPoint);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        $decodedResponse = json_decode($response, true);
        return $decodedResponse;
    }

    /* Тест №2 */
    public function getOtdeleniyaByCity($city)
    {
        $method = 'getWarehouses';
        $model = 'Address';
        
        $params = array(
            'modelName' => $model,
            'calledMethod' => $method,
            'apiKey' => $this->apiKey,
            'CityName' => $city
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->entryPoint);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        $decodedResponse = json_decode($response, true);
        return $decodedResponse;
    }
    
}
