<?php

// retrieve film data from API
$shows = (array) $moviesAPI->getResultsArray( $query, 'tv', $include_adult );
// count the records
$ct_tv              = (int) count( $shows );
// format for display
for ( $f=0; $f<$ct_tv; $f++ )
{
    $show           = (array) $shows[ $f ];
    $show_id        = trim( (string) $show[ 'id' ] );
    $show_title     = trim( (string) $show[ 'name' ] );
    $show_overview  = trim( (string) $show[ 'overview' ] );
    $tv_href        = 'tv.php?id=' . $show_id;
    $tv_results     .= '<li class="list-group-item d-flex justify-content-between align-items-center">'
        . '<strong><em>'
        . '<a data-toggle="tooltip" data-placement="bottom"'
        . ' href="' . $tv_href . '" title="'
        . strtoupper( $show_title ) . ': ' 
        . htmlentities( $show_overview ) . ' ...">' 
        . $show_title
        . '</a>'
        . '</em></strong>';
    if( $show_overview )
        $tv_results .= '<br />(' . substr( htmlentities( $show_overview ), 0, 100 ) . ' ...)';
    $tv_results     .= $moviesAPI->btnGoToResult( $tv_href );
    $tv_results     . '</li>';
}
$tv_response        = "Top Television Results{$forQuery}:"
    . ' <span class="badge badge-primary badge-pill">'
    . $ct_tv
    . '</span>';