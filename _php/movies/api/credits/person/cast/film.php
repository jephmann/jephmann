<?php
// Film Performance
$film_cast      = ( $allow_adult )
                ? $film[ 'cast' ]
                : $moviesAPI->filterAdult( $film[ 'cast'] );

$ct_film_cast   = (int) count( $film_cast );

$film_performance   = '<p><em>No film performances in the system.</em></p>';
if( $ct_film_cast > 0 )
{
    $film_performance = '';
    
    // Define 'release_date' index where missing
    for( $i=0; $i<$ct_film_cast; $i++)
    {
        if( !array_key_exists('release_date', $film_cast[$i]) )
        {
            $film_cast[$i]['release_date'] = '';
        }
    }  

    foreach( $film_cast as $key => $row )
    {
        $release_date[ $key ]   = $row[ 'release_date' ];
        $title[ $key ]          = $row[ 'title' ];
    }
    array_multisort(
        $release_date, SORT_ASC,
        $title, SORT_ASC,
        $film_cast
    );

    foreach( $film_cast as $fCast )
    {
        $fCast_id           = (string) $fCast[ 'id' ];
        $fCast_title        = (string) $fCast[ 'title' ];
        $fCast_character    = array_key_exists( 'character', $fCast )
            ? preg_replace( '~\s?/\s?~', '<br />', (string) $fCast[ 'character' ] )
            : '';
        $fCast_release_year  = '????';
        if( array_key_exists( 'release_date', $fCast ))
        {        
            $fCast_release   = trim( (string) $fCast[ 'release_date' ] );
            if( !empty( $fCast_release ) )
            {
                $fCast_release_date = new DateTime( $fCast_release );
                $fCast_release_year = $fCast_release_date->format( 'Y' );
            }            
        }        
        $film_performance .= "<p>"
            . "{$fCast_release_year}&nbsp;&nbsp;"
            . "<strong><em>"
            . "<a href=\"film.php?id={$fCast_id}\">{$fCast_title}</a>"
            . "</em></strong>"
            . "<br /><strong>{$fCast_character}</strong>"
            . "</p>";        
    }
}