<?php

// retrieve film data from API
$films      = (array) $moviesAPI->getResultsArray(
                $query, 'movie', $include_adult
            );
$ct_films   = (int) count( $films );
for ( $f=0; $f<$ct_films; $f++ )
{
    $film           = (array) $films[ $f ];
    $film_id        = (string) $film[ 'id' ];
    $film_title     = (string) $film[ 'title' ];
    $film_overview  = (string) $film[ 'overview' ];
    $film_results   .= '<li><a href="film.php?id=' 
        . $film_id . '" title="'
        . strtoupper( $film_title ) . ': ' 
        . htmlentities( $film_overview ) .' ..."><em>' 
        . $film_title . '</em></a></li>';            
}    
$film_response      = "Top Film Results{$forQuery}: {$ct_films}";