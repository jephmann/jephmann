<?php

// retrieve film data from API
$shows              = (array) $moviesAPI->getResultsArray(
                        $query, 'tv', $include_adult
                    );
$ct_tv              = (int) count( $shows );
for ( $f=0; $f<$ct_tv; $f++ )
{
    $show           = (array) $shows[ $f ];
    $show_id        = (string) $show[ 'id' ];
    $show_title     = (string) $show[ 'name' ];
    $show_overview  = (string) $show[ 'overview' ];
    $tv_results     .= '<li><a data-toggle="tooltip" href="tv.php?id=' 
        . $show_id . '" title="'
        . strtoupper( $show_title ) . ': ' 
        . htmlentities( $show_overview ) .' ..."><em>' 
        . $show_title . '</em></a></li>';
}    
$tv_response        = "Top Television Results{$forQuery}: {$ct_tv}";