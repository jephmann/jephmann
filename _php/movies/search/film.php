<?php

// retrieve film data from API
$films = (array) $moviesAPI->getResultsArray( $query, 'movie', $include_adult );
// count the records
$ct_films = (int) count( $films );
// format for display
for ( $f=0; $f<$ct_films; $f++ )
{
    $film           = (array) $films[ $f ];
    $film_id        = trim( (string) $film[ 'id' ] );
    $film_title     = trim( (string) $film[ 'title' ] );
    $film_overview  = trim( (string) $film[ 'overview' ] );
    $film_href      = 'film.php?id=' . $film_id;
    $film_results   .= '<li class="list-group-item d-flex justify-content-between align-items-center">'
        . '<strong><em>'
        . '<a data-toggle="tooltip" data-placement="bottom"'
        . ' href="' . $film_href . '" title="'
        . strtoupper( $film_title ) . ': ' 
        . htmlentities( $film_overview ) . ' ...">' 
        . $film_title
        . '</a>'
        . '</em></strong>';
    if( $film_overview )
        $film_results   .= '<br />(' . substr( htmlentities( $film_overview ), 0, 100 ) . ' ...)';
    $film_results       .= $moviesAPI->btnGoToResult( $film_href );
    $film_results       . '</li>';
}
$film_response      = "Top Film Results{$forQuery}:"
    . ' <span class="badge badge-primary badge-pill">'
    . $ct_films
    . '</span>';