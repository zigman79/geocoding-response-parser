<?php
namespace Zigman\GeocodingResponseParser;

class ResponseParser
{
    protected $response;
    
    public function __construct($response)
    {
        $this->response = json_decode($response);
    }

    public function response()
    {
        return $this->response;
    }

    private function findAddressType($search) {
        if (!isset($this->response->results[0]->address_components)) {
            return false;
        }
        foreach ($this->response->results[0]->address_components as $component) {
            foreach ($component->types as $type) {
                if ($type == $search) {
                    return $component->long_name;
                }
            }
        }
        return false;
    }
    
    public function getStreet() {
        return $this->findAddressType("route");
    }
    
    public function getStreetNumber() {
        return $this->findAddressType("street_number");
    }
    
    public function getFullStreet() {
        return $this->getStreet() . " " .$this->getStreetNumber();
    }
    
    public function getCity()
    {
        return $this->findAddressType("locality");
    }

    public function getCitycode() {
        return $this->findAddressType("postal_code");
    }

    public function hasFullAddress() {
        return $this->getCity() && $this->getCitycode() && $this->getStreet() && $this->getStreetNumber();
    }
}
