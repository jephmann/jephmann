<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ApiWeather
 *
 * @author User
 */
class ApiWeather extends Api implements iApiWeather
{
   
    /*
     * Properties
     */

    private $key    = iApiWeather::KEY;
    private $url    = iApiWeather::URL;
   
    /*
     * Methods
     */

    function urlWeather( 
        string $location    = 'San Jacinto',
        int $days           = 0,
        string $format      = 'json'
    ) : string
    {
        $type       = $days ? 'forecast' : 'current';
        $forecast   = $days ? "&days={$days}" : '';
        $result     = $this->url
            . $type . '.' . strtolower( $format )
            . '?key=' . $this->key
            . '&q=' . preg_replace( '~\s~', '+', trim( $location ) )
            . $forecast;
        return $result;
    }
    
    // retrieve search results array for weather
    function getWeatherJSON(
        string $location    = 'Chicago',
        int $days           = 0
    ) : array
    {
        $url    = (string) $this->urlWeather(
                    $location, $days
                );        
        try
        {
            $data   = (array) $this->getJsonArray( $url );
        }
        catch ( Exception $ex )
        {
            $data   = array();
        }        
        return $data;
    }
    
}
