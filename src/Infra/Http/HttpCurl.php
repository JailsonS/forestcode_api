<?php
namespace Src\Infra\Http;

use Src\Infra\Http\HttpAdapter;

class HttpCurl implements HttpAdapter
{
    public function get(string $url, array $header): array
    {
        $response = ['error' => ''];

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        
        $data = curl_exec($curl);

        if($data === false) {
            $response['error'] = curl_error($curl);    
            curl_close($curl); 
            return $response;
        }
        
        $response['data'] = json_decode($data, true);
        curl_close($curl);

        return $response;
    }

    public function post(string $url, array $header, array $data): array
    {

        $response = ['error' => ''];

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_POST, $data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        if(curl_exec($curl) === false) {
            $response['error'] = curl_error($curl);
        }

        curl_close($curl);

        return $response;
    }
}