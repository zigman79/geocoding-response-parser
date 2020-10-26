<?php
namespace Zigman\GeocodingResponseParser;

class ResponseParser
{
    protected $response;
    protected $index = 0;
    
    public function __construct($response)
    {
        $this->response = json_decode($response);
        while (count($this->response->results)>$this->index && strlen($this->getStreet())<=7) {
            $this->index++;
        }
    }

    public function response()
    {
        return $this->response;
    }

    private function findAddressType($search,$name = "long_name") {
        if (!isset($this->response->results[$this->index]->address_components)) {
            return false;
        }
        foreach ($this->response->results[$this->index]->address_components as $component) {
            foreach ($component->types as $type) {
                if ($type == $search) {
                    return $component->$name;
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

    public function getCountry() {
        return $this->findAddressType("country");
    }

    public function getCountryShortName() {
        return $this->findAddressType("country","short_name");
    }

    public function hasFullAddress() {
        return $this->getCity() && $this->getCitycode() && $this->getStreet() && $this->getStreetNumber();
    }

    public function formatted_address() {
        return $this->response->results[$this->index]->formatted_address;
    }
    
    public function getLatitude() {
        return $this->response->results[$this->index]->geometry->location->lat;
    }

    public function getLongitude() {
        return $this->response->results[$this->index]->geometry->location->lng;
    }

}
