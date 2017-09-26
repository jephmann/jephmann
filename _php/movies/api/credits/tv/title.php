<?php


/*
 * Retrieve main data for TV Title
 */



// title
$title                          = (array) $moviesAPI->getSubTopicData(
                                    $id, 'tv', 'show'
                                );
$title_title                    = trim( (string) $title[ 'name' ] );
$title_release_date             = trim( (string) $title[ 'first_air_date' ] );
$title_poster_path              = trim( (string) $title[ 'poster_path' ] );
$title_tagline                  = '';
$title_overview                 = trim( (string) $title[ 'overview' ] );
$title_imdb                     = '';
$title_genres                   = (array) $title[ 'genres' ];
$title_production_companies     = (array) $title[ 'production_companies' ]; 
$ct_title_genres                = (int) count( $title_genres );
$ct_title_production_companies  = (int) count( $title_production_companies );

// main image
$image_title                    = empty( $title_poster_path )
                                ? "{$path}_images/no_pic.jpg"
                                : (string) $moviesAPI->urlImage( $title_poster_path );

// gallery images
$images                         = (array) $moviesAPI->getSubTopicData(
                                    $id, 'tv', 'images'
                                );
$images_posters                 = (array) $images[ 'posters' ];    
$images_backdrops               = (array) $images[ 'backdrops' ];
$ct_posters                     = (int) count( $images_posters );
$ct_backdrops                   = (int) count( $images_backdrops );

// videos
$videos                         = (array) $moviesAPI->getSubTopicData(
                                    $id, 'tv', 'videos'
                                );

/*
 *  OVERVIEW
 */
$overview_release   = '';
$title_release_year = '????';
if( !empty( $title_release_date ) )
{
    $cast_release_date  = new DateTime( $title_release_date );
    $title_release_year = $cast_release_date->format( 'Y' );
    $overview_release   = "<p>Release Date:"
        . "&nbsp;{$cast_release_date->format( 'F j, Y' )}</p>";
}

$urlIMDB = !empty( $title_imdb )
    ? (string) $moviesIMDB->getTitleUrl( $title_imdb )
    : '';

$urlMovieDB = (string) $moviesAPI->getPublicUrl( $id, 'movie' );

$overview_genres = '';
if ( $ct_title_genres > 0 )
{
    $array_genres           = array();
    foreach ($title_genres as $genre )
    {
        $genre_name         = trim( (string) $genre[ 'name' ] );
        $array_genres[]     = $genre_name;
    }
    $overview_genres = '<p>' . implode( ' | ', $array_genres ) . '</p>';
}

$overview_companies = '';
if ( $ct_title_production_companies > 0 )
{
    $array_companies        = array();
    foreach ($title_production_companies as $company )
    {
        $company_name       = trim( (string) $company[ 'name' ] );
        $array_companies[]  = $company_name;
    }
    $overview_companies = '<p>' . implode( ' | ', $array_companies ) . '</p>';
}

/*
 * Additional per-page variables
 */

$subtitle .= ": {$title_title} ({$title_release_year})";

$creditFooter   = "Click the heading above to show or hide the list.";

//for Twitter sharebuttons (delimit with comma)
$hashtag = 'themoviedb,jephmann';

//  Custom (per page) meta
$meta_image         = $image_title;
$meta_description   = htmlspecialchars( $title_overview )
                    . ' | Data courtesy of TheMovieDB.com | ';
$meta_querystring   = "?id={$id}";

/*
 * Retrive credit data, to be split
 * according to Cast/Performance and Crew/Production
 */
$credits    = (array) $moviesAPI->getSubTopicData(
                $id, 'tv', 'credits'
            );
