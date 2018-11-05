<?php

// retrieve person data from API
$people     = (array) $moviesAPI->getResultsArray(
                $query, 'person', $include_adult
            );
$ct_people  = (int) count( $people );  
for ( $r=0; $r<$ct_people; $r++ )
{
    $person         = (array) $people[ $r ];        
    $person_id      = (string) $person['id'];
    $person_name    = (string) $person[ 'name' ];
    $person_kf      = (array) $person[ 'known_for'];
    $ct_kf          = (int) count( $person_kf );
    $kf_titles = array();
    for( $kf=0; $kf<$ct_kf; $kf++ )
    {
        if( array_key_exists( 'title', $person_kf[ $kf ] ) )
        {
            $kf_titles[ $kf ] = (string) $person_kf[ $kf ]['title'];
        }
    }
    $known_for          = !empty( $kf_titles )
                        ? (string) implode( '; ', $kf_titles )
                        : '';    
    $person_known_for   = !empty( $known_for )
            ? ", known for: {$known_for}"
            : '';
    $person_results    .= '<li class="list-group-item d-flex justify-content-between align-items-center">'
        . '<a data-toggle="tooltip" href="name.php?id='
        . $person_id . '" title="'
        . strtoupper( $person_name ) 
        . htmlentities( $person_known_for ) .'">' 
        . $person_name . '</a></li>';            
}    
$person_response       = "Top Name Results{$forQuery}: {$ct_people}";