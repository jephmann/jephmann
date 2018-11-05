<?php

// retrieve film data from API
$shows              = (array) $moviesAPI->getResultsArray(
                        $query, 'tv', $include_adult
                    );
$ct_tv              = (int) count( $shows );
for ( $f=0; $f<$ct_tv; $f++ )
{
    $show           = (array) $shows[ $f ];
    $show_id        = trim( (string) $show[ 'id' ] );
    $show_title     = trim( (string) $show[ 'name' ] );
    $show_overview  = trim( (string) $show[ 'overview' ] );
    $tv_results     .= '<li class="list-group-item d-flex justify-content-between align-items-center">'
        . '<strong><em>'
        . '<a data-toggle="tooltip" href="tv.php?id=' 
        . $show_id . '" title="'
        . strtoupper( $show_title ) . ': ' 
        . htmlentities( $show_overview ) .' ...">' 
        . $show_title
        . '</a>'
        . '</em></strong>';
    if( $show_overview )
        $tv_results .= '<br />(' . $show_overview . ')';
    $film_results   . '</li>';
}
$tv_response        = "Top Television Results{$forQuery}: {$ct_tv}";