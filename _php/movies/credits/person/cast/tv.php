<?php
// TV Performance
$tv_cast        = (array) $tv[ 'cast' ];
$ct_tv_cast     = (int) count( $tv_cast );

$tv_performance = '<p><em>No TV performances in the system.</em></p>';
if( $ct_tv_cast > 0 )
{
    $tv_performance = '';
    
    // Define 'first_air_date' index where missing
    for($i=0;$i<$ct_tv_cast;$i++)
    {
        if( !array_key_exists('first_air_date', $tv_cast[$i]) )
        {
            $tv_cast[$i]['first_air_date']='';
        }
    }  
    
    // sort by 'first_air_date'
    foreach( $tv_cast as $tv_role )
    {
        $first_air_date[]   = $tv_role[ 'first_air_date' ];
    }
    array_multisort(
        $first_air_date, SORT_ASC, $tv_cast
    );
    
    foreach( $tv_cast as $tCast )
    {
        $tCast_id           = (string) $tCast[ 'id' ];
        $tCast_name         = (string) $tCast[ 'name' ];
        $tCast_character    = array_key_exists( 'character', $tCast )
            ? preg_replace( '~\s?/\s?~', '<br />', (string) $tCast[ 'character' ] )
            : '';
        $tCast_first_year    = '????';
        if( array_key_exists( 'first_air_date', $tCast ))
        {        
            $tCast_first       = trim( (string) $tCast[ 'first_air_date' ] );
            if( !empty( $tCast_first ) )
            {
                $tCast_first_date = new DateTime( $tCast_first );
                $tCast_first_year = $tCast_first_date->format( 'Y' );
            }            
        }
        $tv_performance .= "<li "
            . "class=\"list-group-item d-flex justify-content-between align-items-center\">"
            . "{$tCast_first_year}&nbsp;&nbsp;"
            . "<strong><em>"
            . "<a href=\"tv.php?id={$tCast_id}\">{$tCast_name}</a>"
            . "</em></strong>"
            . "<br /><strong>{$tCast_character}</strong>"
            . "</li>";            
    }

}
    
// build Credits panel
$creditsPerformancesTV = (string) Tools::panelCredits
(
    $ct_tv_cast,
    'TV Performances',
    $tv_performance
);