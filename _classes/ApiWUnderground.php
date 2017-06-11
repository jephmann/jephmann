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
            'city' => 'Arlington Heights',
            'state' => 'IL'
            ),
        array(
            'city' => 'Ashburn',
            'state' => 'VA'
            ),
        array(
            'city' => 'Atlanta',
            'state' => 'GA'
            ), 
        array(
            'city' => 'Atlantic City',
            'state' => 'NJ'
            ), 
        array(
            'city' => 'Austin',
            'state' => 'TX'
            ), 
        array(
            'city' => 'Aurora',
            'state' => 'IL'
            ),
        array(
            'city' => 'Baltimore',
            'state' => 'MD'
            ),    
        array(
            'city' => 'Baraboo',
            'state' => 'WI'
            ),
        array(
            'city' => 'Benson',
            'state' => 'AZ'
            ),    
        array(
            'city' => 'Berkeley',
            'state' => 'CA'
            ),
        array(
            'city' => 'Berwyn',
            'state' => 'IL'
            ),
        array(
            'city' => 'Beverly Hills',
            'state' => 'CA'
            ),    
        array(
            'city' => 'Billings',
            'state' => 'MT'
            ),    
        array(
            'city' => 'Boise',
            'state' => 'ID'
            ),
        array(
            'city' => 'Boston',
            'state' => 'MA'
            ),
        array(
            'city' => 'Buffalo',
            'state' => 'NY'
            ),
        array(
            'city' => 'Burbank',
            'state' => 'CA'
            ),
        array(
            'city' => 'Chatsworth',
            'state' => 'CA'
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
            'city' => 'Columbia',
            'state' => 'IL'
            ),
        array(
            'city' => 'Dallas',
            'state' => 'TX'
            ),
        array(
            'city' => 'Dayton',
            'state' => 'OH'
            ),
        array(
            'city' => 'Deerfield',
            'state' => 'IL'
            ),
        array(
            'city' => 'Denton',
            'state' => 'TX'
            ),
        array(
            'city' => 'Detroit',
            'state' => 'MI'
            ),
        array(
            'city' => 'East Saint Louis',
            'state' => 'IL'
            ),
        array(
            'city' => 'Evanston',
            'state' => 'IL'
            ),
        array(
            'city' => 'Fort Lauderdale',
            'state' => 'FL'
            ),
        array(
            'city' => 'Galena',
            'state' => 'IL'
            ),    
        array(
            'city' => 'Glendale',
            'state' => 'CA'
            ),
        array(
            'city' => 'Green Bay',
            'state' => 'WI'
            ),    
        array(
            'city' => 'Highland Park',
            'state' => 'IL'
            ),
        array(
            'city' => 'Homer Glen',
            'state' => 'IL'
            ),
        array(
            'city' => 'Houston',
            'state' => 'TX'
            ),
        array(
            'city' => 'Jacksonville',
            'state' => 'SC'
            ), 
        array(
            'city' => 'Joliet',
            'state' => 'IL'
            ),
        array(
            'city' => 'Kansas City',
            'state' => 'MO'
            ),
        array(
            'city' => 'Kingsville',
            'state' => 'TX'
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
            'city' => 'Malibu',
            'state' => 'CA'
            ),
        array(
            'city' => 'Memphis',
            'state' => 'TN'
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
            'city' => 'Mobile',
            'state' => 'AL'
            ),
        array(
            'city' => 'Mundelein',
            'state' => 'IL'
            ),
        array(
            'city' => 'Muskegon',
            'state' => 'MI'
            ),
        array(
            'city' => 'Nashville',
            'state' => 'TN'
            ),
        array(
            'city' => 'New Orleans',
            'state' => 'LA'
            ), 
        array(
            'city' => 'New York',
            'state' => 'NY'
            ),     
        array(
            'city' => 'Oak Park',
            'state' => 'IL'
            ),     
        array(
            'city' => 'Oakland',
            'state' => 'CA'
            ),     
        array(
            'city' => 'Omaha',
            'state' => 'NE'
            ),    
        array(
            'city' => 'Ottumwa',
            'state' => 'IA'
            ),    
        array(
            'city' => 'Park Ridge',
            'state' => 'IL'
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
            'city' => 'Pigeon Forge',
            'state' => 'TN'
            ),
        array(
            'city' => 'Piqua',
            'state' => 'KS'
            ),
        array(
            'city' => 'Piscataway',
            'state' => 'NJ'
            ),
        array(
            'city' => 'Pittsburgh',
            'state' => 'PA'
            ),
        array(
            'city' => 'Portland',
            'state' => 'OR'
            ),
        array(
            'city' => 'Portland',
            'state' => 'ME'
            ),    
        array(
            'city' => 'Reno',
            'state' => 'NV'
            ), 
        array(
            'city' => 'Rockford',
            'state' => 'IL'
            ), 
        array(
            'city' => 'Sacramento',
            'state' => 'CA'
            ),    
        array(
            'city' => 'Saint George',
            'state' => 'UT'
            ), 
        array(
            'city' => 'Saint Louis',
            'state' => 'MO'
            ), 
        array(
            'city' => 'Saint Paul',
            'state' => 'MN'
            ), 
        array(
            'city' => 'Salt Lake City',
            'state' => 'UT'
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
            'city' => 'San Jose',
            'state' => 'CA'
            ),    
        array(
            'city' => 'Santa Clarita',
            'state' => 'CA'
            ),    
        array(
            'city' => 'Santa Monica',
            'state' => 'CA'
            ),
        array(
            'city' => 'Schiller Park',
            'state' => 'IL'
            ),
        array(
            'city' => 'Seattle',
            'state' => 'WA'
            ),
        array(
            'city' => 'Sherman Oaks',
            'state' => 'CA'
            ),
        array(
            'city' => 'Spokane',
            'state' => 'WA'
            ),
        array(
            'city' => 'Springfield',
            'state' => 'IL'
            ),
        array(
            'city' => 'Springfield',
            'state' => 'MO'
            ),
        array(
            'city' => 'Tampa',
            'state' => 'FL'
            ),
        array(
            'city' => 'Toledo',
            'state' => 'OH'
            ),
        array(
            'city' => 'Tuckahoe',
            'state' => 'VA'
            ),
        array(
            'city' => 'Valparaiso',
            'state' => 'IN'
            ),
        array(
            'city' => 'Wall Township',
            'state' => 'NJ'
            ),
        array(
            'city' => 'Washington',
            'state' => 'DC'
            ),
        array(
            'city' => 'Webster Groves',
            'state' => 'MO'
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
    
    public function urlRadar(
        string $city,
        string $state ) : string
    {
        $new_city = str_replace( ' ', '_', $city );
        return "{$this->baseURL()}/animatedradar/q/{$state}/{$new_city}.gif"
        . "?newmaps=1&timelabel=1&timelabel.y=10&num=5&delay=200";       
    }
        
}
