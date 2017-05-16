<?php

class IMDB {
    
    /*
     * properties
     */
    
    public $base_url = "http://www.imdb.com/";
    
    /*
     * methods
     */
    
    function getTitleUrl( string $tt ) : string
    {
        return "{$this->base_url}title/{$tt}/fullcredits";
    }
    
    function getNameUrl( string $nm ) : string
    {
        return "{$this->base_url}name/{$nm}/";
    }
    
}
