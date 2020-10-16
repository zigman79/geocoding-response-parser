<?php
namespace Zigman\GeocodingResponseParser;

class ResponseParser
{
    protected $response;
    
    public function __construct($response) {
        $this->response = json_decode($response);
    }

    public function dump() {
        var_dump($this->response);
    }

    public function getCity() {

    }
}
