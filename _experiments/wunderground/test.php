<?php

$path       = '../../';
$autoload   = $path . '_php/autoload.php';
require_once $autoload;

// Class tests
$weatherAPI = new ApiWUnderground;

$features   = $weatherAPI->features;
echo "<pre>";
print_r( $features );
echo "</pre>";

$locations  = $weatherAPI->locations;
echo "<pre>";
print_r( $locations );
echo "</pre>";

$default    = 20;
$feature    = (string) $features[ 0 ];
$city       = (string) $locations[ $default ][ 'city' ];
$state      = (string) $locations[ $default ][ 'state' ];

$jsonArray = $weatherAPI->arrayReport( $feature, $city, $state );

echo "<h1>{$feature}</h1>";
echo "<h2>{$city}, {$state}</h2>";

echo "<pre>";
print_r( $jsonArray );
echo "</pre>";
