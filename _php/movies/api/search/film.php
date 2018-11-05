<?php

// retrieve film data from API
$films      = (array) $moviesAPI->getResultsArray(
                $query, 'movie', $include_adult
            );
$ct_films   = (int) count( $films );
for ( $f=0; $f<$ct_films; $f++ )
{
    $film           = (array) $films[ $f ];
    $film_id        = trim( (string) $film[ 'id' ] );
    $film_title     = trim( (string) $film[ 'title' ] );
    $film_overview  = trim( (string) $film[ 'overview' ] );
    $film_results   .= '<li class="list-group-item d-flex justify-content-between align-items-center">'
        . '<strong><em>'
        . '<a data-toggle="tooltip" href="film.php?id=' 
        . $film_id . '" title="'
        . strtoupper( $film_title ) . ': ' 
        . htmlentities( $film_overview ) .' ...">' 
        . $film_title
        . '</a>'
        . '</em></strong>';
    if( $film_overview )
        $film_results .= '<br />(' . $film_overview . ')';
    $film_results   . '</li>';
}
$film_response      = "Top Film Results{$forQuery}: {$ct_films}";