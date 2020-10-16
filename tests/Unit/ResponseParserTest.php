<?php

use Zigman\GeocodingResponseParser\ResponseParser;

it('converts json constructor', function ($response) {

    $parser = new ResponseParser($response);

    expect($parser->response())->toHaveProperty('results');

})->with('response');


it('returns street', function ($response) {

    $parser = new ResponseParser($response);

    expect($parser->getStreet())->toEqual('Straße des 18. Oktober');

})->with('response');


it('returns street number', function ($response) {

    $parser = new ResponseParser($response);

    expect($parser->getStreetNumber())->toEqual('102');

})->with('response');


it('returns full street', function ($response) {

    $parser = new ResponseParser($response);

    expect($parser->getFullStreet())->toEqual('Straße des 18. Oktober 102');

})->with('response');


it('returns city', function ($response) {

    $parser = new ResponseParser($response);

    expect($parser->getCity())->toEqual('Leipzig');

})->with('response');


it('returns city code', function ($response) {

    $parser = new ResponseParser($response);

    expect($parser->getCitycode())->toEqual('04103');

})->with('response');


it('has full address', function ($response) {

    $parser = new ResponseParser($response);

    expect($parser->hasFullAddress())->toBeTrue();

})->with('response');


it('returns latitude', function ($response) {

    $parser = new ResponseParser($response);

    expect($parser->getLatitude())->toEqual('51.3221623');

})->with('response');

it('returns longitude', function ($response) {

    $parser = new ResponseParser($response);

    expect($parser->getLongitude())->toEqual('12.394733');

})->with('response');
