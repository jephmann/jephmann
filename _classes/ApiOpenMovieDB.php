<?php

class ApiOpenMovieDB extends Api implements iApiOpenMovieDB
{
    /*
     * Attributes
     */
    
    private $key            = iApiOpenMovieDB::KEY;
    private $url            = 'http://www.omdbapi.com/';    
    
    /*
     * Methods
     */
    
    public function getTitleData( string $ttIMDB, bool $plot = TRUE ) : array
    {        
        $url = $this->url . '?i=' . $ttIMDB . '&apikey=' . $this->key;
        // TRUE = long plot; FALSE = short plot.
        if ( $plot )
            $url .= '&plot=full';
        return (array) $this->getJsonArray( $url );
    }
    
    public function nullNA( string $string ) : string
    {
        $result = ($string === 'N/A') ? '' : trim( $string );
        return $result;
    }
}
