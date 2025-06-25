<?php
namespace WebScrapingApi;

use Symfony\Component\HttpClient\HttpClient;

class Client
{
    public $api_key;
    public $api_url;

    public function __construct($key)
    {
        $this->api_key = $key;
        $this->api_url = "https://api.webscrapingapi.com/v1";
    }

    public function request($method, $url,  $params = [], $headers = [], $body = [])
    {
        $final_params = array("api_key" => $this->api_key, "url" => $url) + $params;
        $query = http_build_query($final_params);
        $final_url = $this->api_url."?".$query;
        $httpClient = HttpClient::create();

        try {
            $http_response = $httpClient->request($method, $final_url,
                [
                'headers' => $headers,
                'json' => $body
                ],
            );
            $final_response = array(
                "success" => "true",
                "response" => json_decode($http_response -> getContent()) ?: $http_response -> getContent()
            );
            return json_encode($final_response, JSON_PRETTY_PRINT);

        } catch (\Exception $e) {

            $final_response = array (
                'success' => 'false',
                'error' => $e->getMessage()
            );
            return json_encode($final_response, JSON_PRETTY_PRINT);
        }
    }

    public function get($url, $params = [], $headers = [])
    {
        return $this->request("GET", $url, $params, $headers, []);
    }

    public function post($url, $params = [], $headers = [], $body = [])
    {
        return $this->request("POST", $url, $params, $headers, $body);
    }
}