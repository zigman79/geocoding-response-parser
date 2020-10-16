<?php
namespace GeocodingResponseParser;

class SayHello
{
    protected $response;
    public function __construct($response) {
        $this->response = json_decode($response);
    }

    public function dump() {
        var_dump($this->response);
    }
}
