<?php

class ApiWUnderground extends Api
{
    /*
     * Attributes
     */

    private $key                    = "fa4a10d736578d22";
    private $url                    = "http://api.wunderground.com/api";
    
    public $features                = array(
        'alerts', 'almanac', 'astronomy', 'conditions', 'currenthurricane',
        'forecast', 'forecast10day', 'geolookup', 'history', 'hourly',
        'hourly10day', 'planner', 'rawtide', 'satellite', 'tide',
        'webcams', 'yesterday',
    );
    
    public $locations               = array(
        array(
            'city' => 'Albany',
            'state' => 'NY'
            ),
        array(
            'city' => 'Albuquerque',
            'state'=> 'NM'
            ),
        array(
            'city' => 'Anaheim',
            'state' => 'CA'
            ),
        array(
            'city' => 'Arlington',
            'state' => 'TX'
            ),
        array(
            'city' => 'Atlanta',
            'state' => 'GA'
            ),
        array(
            'city' => 'Baltimore',
            'state' => 'MD'
            ),
        array(
            'city' => 'Boston',
            'state' => 'MA'
            ),
        array(
            'city' => 'Chicago',
            'state' => 'IL'
            ),
        array(
            'city' => 'Cincinnati',
            'state' => 'OH'
            ),
        array(
            'city' => 'Cleveland',
            'state' => 'OH'
            ),
        array(
            'city' => 'Detroit',
            'state' => 'MI'
            ),
        array(
            'city' => 'Houston',
            'state' => 'TX'
            ),
        array(
            'city' => 'Kansas City',
            'state' => 'MO'
            ),
        array(
            'city' => 'Las Vegas',
            'state' => 'NV'
            ),
        array(
            'city' => 'Los Angeles',
            'state' => 'CA'
            ),
        array(
            'city' => 'Miami',
            'state' => 'FL'
            ),
        array(
            'city' => 'Milwaukee',
            'state' => 'WI'
            ),
        array(
            'city' => 'Minneapolis',
            'state' => 'MN'
            ),
        array(
            'city' => 'New York',
            'state' => 'NY'
            ),     
        array(
            'city' => 'Oakland',
            'state' => 'CA'
            ),     
        array(
            'city' => 'Peoria',
            'state' => 'IL'
            ),
        array(
            'city' => 'Philadelphia',
            'state' => 'PA'
            ),
        array(
            'city' => 'Phoenix',
            'state' => 'AZ'
            ),
        array(
            'city' => 'Pittsburgh',
            'state' => 'PA'
            ),
        array(
            'city' => 'Seattle',
            'state' => 'WA'
            ), 
        array(
            'city' => 'Saint Louis',
            'state' => 'MO'
            ),
        array(
            'city' => 'San Diego',
            'state' => 'CA'
            ),
        array(
            'city' => 'San Francisco',
            'state' => 'CA'
            ),
        array(
            'city' => 'Springfield',
            'state' => 'IL'
            ),
        array(
            'city' => 'Tampa',
            'state' => 'FL'
            ),
        array(
            'city' => 'Washington',
            'state' => 'DC'
            ),            
    );

    /*
     * Methods
     */
    
    public function baseURL() : string
    {
        return "{$this->url}/{$this->key}";
    }
    
    public function jsonReport(
            string $feature,
            string $city,
            string $state ) : string
    {
        $new_city = str_replace( ' ', '_', $city );
        return "{$this->baseURL()}/{$feature}/q/{$state}/{$new_city}.json";
    }
    
    public function arrayReport(
            string $feature,
            string $city,
            string $state ) : array
    {
        $new_city = str_replace( ' ', '_', $city );
        return $this->getJsonArray( $this->jsonReport( $feature, $new_city, $state ) );
    }
}
