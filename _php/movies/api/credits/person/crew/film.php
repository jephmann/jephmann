<?php

// Film Production
$film_crew          = (array) $film[ 'crew' ];
$ct_film_crew       = (int) count( $film_crew );

$film_production    = '<p><em>No Film production credits in the system.</em></p>';
if( $ct_film_crew > 0 )
{
    $film_production    = '';
    $fJobs              = array();
    foreach( $film_crew as $fCrew )
    {
        $fJobs[]        = $fCrew[ 'job' ];
    }
    sort( $fJobs );
    $fCrew_jobs         = array_unique( $fJobs );
    $fCrew_jobs_sorted  = array();
    foreach( $fCrew_jobs as $key => $value )
    {
        $film_production    .= "<p><strong>{$value}:</strong>";
        foreach( $film_crew as $fCrew )
        {
            if( $fCrew['job'] === $value )
            {
                $fCrew_id            = (string) $fCrew[ 'id' ];
                $fCrew_title         = (string) $fCrew[ 'title' ];
                
                // Define 'release_date' index where missing
                $fCrew_release_year  = '????';
                $fCrew_release       = ( array_key_exists( 'release_date', $fCrew ) )
                        ? trim( (string) $fCrew[ 'release_date' ] )
                        : '';
                if( !empty( $fCrew_release ) )
                {
                    $fCrew_release_date  = new DateTime( $fCrew_release );
                    $fCrew_release_year  = $fCrew_release_date->format( 'Y' );
                }
                $fCrew_jobs_data = array(
                    'release_year'  => $fCrew_release_year,
                    'title'         => $fCrew_title,
                    'id'            => $fCrew_id,
                );
                array_push( $fCrew_jobs_sorted, $fCrew_jobs_data );
            }
        }
        foreach( $fCrew_jobs_sorted as $key => $row )
        {
            $c_release_year[ $key ] = $row[ 'release_year' ];
            $c_title[ $key ]        = $row[ 'title' ];
        }
        array_multisort(
            $c_release_year, SORT_ASC,
            $c_title, SORT_ASC,
            $fCrew_jobs_sorted
        );
        $fCrew_jobs_unique = array_unique( $fCrew_jobs_sorted, SORT_REGULAR );
        foreach ( $fCrew_jobs_unique as $fcj )
        {
            $fCrew_job_year  = $fcj[ 'release_year' ];
            $fCrew_job_title = $fcj[ 'title' ];
            $fCrew_job_id    = $fcj[ 'id' ];
            $film_production .= "<br />"
                . "{$fCrew_job_year}&nbsp;&nbsp;"
                . "<strong><em>"
                . "<a href=\"film.php?id={$fCrew_job_id}\">"
                . "{$fCrew_job_title}</a>"
                . "</em></strong>";
        }        

        $film_production .= "</p>";
    }
}