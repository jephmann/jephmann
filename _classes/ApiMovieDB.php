<?php

class ApiMovieDB extends Api
{
    /*
     * Attributes
     */

    private $key            = 'f5100af9458f136f2e7e38267a6aabfa';
    private $url            = 'http://api.themoviedb.org/3/';
    public $url_themoviedb  = 'https://www.themoviedb.org/';
    public $url_imdb        = 'http://www.imdb.com/';    
    public $video_types     = array(
        'Trailer', 'Teaser', 'Clip', 'Featurette',
    );
    
    /*
     * Methods
     */
    
    // retrieve TheMovieDB API URLs for topic (movie, person)
    public function getTopicURLs(
        string $id,
        string $topic
    ) : array
    {
        $url                        = "{$this->url}{$topic}/{$id}";
        $queryString                = "?api_key={$this->key}";
        $urls                       = array();
        switch ( $topic )
        {
            case 'person':
                $urls[ "name" ]     = "{$url}{$queryString}";
                $urls[ "images" ]   = "{$url}/images{$queryString}";
                $urls[ "credits" ]  = "{$url}/movie_credits{$queryString}";
                $urls[ "tv"]        = "{$url}/tv_credits{$queryString}";
                break;
            
            // so far, movie and tv have the same pattern
            case 'movie':   // url requires 'movie'; data becomes 'film         
            case 'tv':
                $urls[ "title" ]    = "{$url}{$queryString}";
                $urls[ "titles" ]   = "{$url}/alternative_titles{$queryString}";
                $urls[ "images" ]   = "{$url}/images{$queryString}";
                $urls[ "credits" ]  = "{$url}/credits{$queryString}";
                $urls[ "videos" ]   = "{$url}/videos{$queryString}";
                break;
        }        
        return $urls;
    }
    
    // get data for subtopics of title and movie
    public function getSubTopicData(
        string $id,
        string $topic,
        string $subtopic
    ) : array
    {
        $urls   = (array) $this->getTopicURLs( $id, $topic );
        return (array) $this->getJsonArray( $urls[ $subtopic ] );
    }
    
    // retrieve TheMovieDB API search URLs
    public function getUrlSearch(
        string $text,
        string $type,
        string $include_adult
    ) : string
    {          

        $query          = (string) urlencode( $text );
        $url            = "{$this->url}search/";
        $queryString    = "?api_key={$this->key}"
                        . "&query={$query}"
                        . "&include_adult={$include_adult}";
        return $url . $type . $queryString;
    }
    
    // retrieve data per initial query search
    public function getSearchData(
        string $text,
        string $type,
        string $include_adult
    ) : array
    {
        $url    = (string) $this->getUrlSearch(
                    $text, $type, $include_adult
                );
        return (array) $this->getJsonArray( $url );
    }

    // retrieve TheMovieDB URL of image source
    public function urlImage(
        string $image_path
    ) : string
    {
        if ( !is_null( $image_path ) )
        {
            return "https://image.tmdb.org/t/p/w300_and_h450_bestv2{$image_path}";
        }
    }
    
    // retrive TheMovieDB public URL for name
    function getPublicURL(
        string $id,
        string $topic
    ) : string
    {
        return "{$this->url_themoviedb}{$topic}/{$id}";
    }
    
    // retrieve search results array for either movies or persons
    function getResultsArray(
        string $text,
        string $type,
        string $include_adult
    ) : array
    {
        $url    = (string) $this->getUrlSearch(
                    $text, $type, $include_adult
                );
        $data   = (array) $this->getJsonArray( $url );
        return $data[ 'results' ];
    }
    
}