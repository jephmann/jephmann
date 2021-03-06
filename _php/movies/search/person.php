<?php

// retrieve person data from API
$people     = (array) $moviesAPI->getResultsArray(
                $query, 'person', 'true'
            );
$ct_people  = (int) count( $people );  
for ( $r=0; $r<$ct_people; $r++ )
{
    $person         = (array) $people[ $r ];        
    $person_id      = trim( (string) $person['id'] );
    $person_name    = trim( (string) $person[ 'name' ] );
    $person_kf      = ( !$allow_adult )
            ? $moviesAPI->filterAdult( $person[ 'known_for' ] )
            : $person[ 'known_for' ];
    $ct_kf          = (int) count( $person_kf );
    $kf_titles = array();
    for( $kf=0; $kf<$ct_kf; $kf++ )
    {
        if( array_key_exists( 'title', $person_kf[ $kf ] ) )
        {
            $kf_titles[ $kf ] = (string) $person_kf[ $kf ]['title'];
        }
    }
    $known_for          = ( $kf_titles )
                        ? (string) implode( '; ', $kf_titles )
                        : '';
    $person_known_for   = ( $known_for )
            ? ", known for: {$known_for}"
            : '';
    $person_href        = 'name.php?id=' . $person_id;    
    $person_results    .= '<li class="list-group-item d-flex justify-content-between align-items-center">'
        . '<strong>'
        . '<a data-toggle="tooltip" data-placement="bottom"'
        . ' href="' . $person_href . '" title="'
        . strtoupper( $person_name ) 
        . htmlentities( $person_known_for ) . '">' 
        . $person_name . '</a>'
        . '</strong>';
    if ($known_for)
        $person_results .= '<br />(' . $known_for . ')';
    $person_results     .= $moviesAPI->btnGoToResult( $person_href );
    $person_results     .= '</li>';
}
$person_response       = "Top Name Results{$forQuery}: "
    . ' <span class="badge badge-primary badge-pill">'
    . $ct_people
    . '</span>';