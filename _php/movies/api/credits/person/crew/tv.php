<?php

// TV Production
$tv_crew            = (array) $tv[ 'crew' ];
$ct_tv_crew         = (int) count( $tv_crew );

$tv_production      = '<p><em>No TV production credits in the system.</em></p>';
if( $ct_tv_crew > 0 )
{
    $tv_production      = '';
    $tJobs              = array();
    foreach( $tv_crew as $tCrew )
    {
        $tJobs[]        = $tCrew[ 'job' ];
    }
    sort( $tJobs );
    $tCrew_jobs         = array_unique( $tJobs );
    $tCrew_jobs_sorted  = array();
    foreach( $tCrew_jobs as $key => $value )
    {
        $tv_production      .= "<p><strong>{$value}:</strong>";
        foreach( $tv_crew as $tCrew )
        {
            if( $tCrew['job'] === $value )
            {
                $tCrew_id            = (string) $tCrew[ 'id' ];
                $tCrew_title         = (string) $tCrew[ 'name' ];
                
                // Define 'first_air_date' index where missing
                {
                    if( !array_key_exists('first_air_date', $tCrew) )
                    {
                        $tCrew['first_air_date']='';
                    }
                }
                
                $tCrew_release_year  = '????';
                $tCrew_release       = trim( (string) $tCrew[ 'first_air_date' ] );                    
                if( !empty( $tCrew_release ) )
                {
                    $tCrew_release_date  = new DateTime( $tCrew_release );
                    $tCrew_release_year  = (string) $tCrew_release_date->format( 'Y' );
                }
                $tCrew_jobs_data = array(
                    'release_year'  => (string) $tCrew_release_year,
                    'name'          => (string) $tCrew_title,
                    'id'            => (int) $tCrew_id, 
                );
                array_push( $tCrew_jobs_sorted, $tCrew_jobs_data );
            }
        }        

        foreach( $tCrew_jobs_sorted as $key => $row )
        {
            $release_year[$key] = $row['release_year'];
        }
        array_multisort(
            $release_year, SORT_ASC, $tCrew_jobs_sorted
        );
        $tCrew_jobs_unique = array_unique( $tCrew_jobs_sorted, SORT_REGULAR );
        
        foreach ( $tCrew_jobs_unique as $tcj )
        {
            $tCrew_job_year  = $tcj[ 'release_year' ];
            $tCrew_job_title = $tcj[ 'name' ];
            $tCrew_job_id    = $tcj[ 'id' ];
            $tv_production .= "<br />"
                . "{$tCrew_job_year}&nbsp;&nbsp;"
                . "<strong><em>"
                . "<a href=\"tv.php?id={$tCrew_job_id}\">"
                . "{$tCrew_job_title}</a>"
                . "</em></strong>";
        }        

        $tv_production .= "</p>";
    }
}