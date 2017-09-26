<?php

/*
 * Retrieve main data for Movie Title
 */

// title
$film                          = (array) $moviesAPI->getSubTopicData(
                                    $id, 'movie', 'title'
                                );
$film_title                    = trim( (string) $film[ 'title' ] );
$film_release_date             = trim( (string) $film[ 'release_date' ] );
$film_poster_path              = trim( (string) $film[ 'poster_path' ] );
$film_tagline                  = trim( (string) $film[ 'tagline' ] );
$film_overview                 = trim( (string) $film[ 'overview' ] );
$film_imdb                     = trim( (string) $film[ 'imdb_id' ] );
$film_genres                   = (array) $film[ 'genres' ];
$film_production_companies     = (array) $film[ 'production_companies' ]; 
$ct_film_genres                = (int) count( $film_genres );
$ct_film_production_companies  = (int) count( $film_production_companies );

// main image
$image_film                    = empty( $film_poster_path )
                                ? "{$path}_images/no_pic.jpg"
                                : (string) $moviesAPI->urlImage( $film_poster_path );

// gallery images
$images                         = (array) $moviesAPI->getSubTopicData(
                                    $id, 'movie', 'images'
                                );
$images_posters                 = (array) $images[ 'posters' ];    
$images_backdrops               = (array) $images[ 'backdrops' ];
$ct_posters                     = (int) count( $images_posters );
$ct_backdrops                   = (int) count( $images_backdrops );

// videos
$videos                         = (array) $moviesAPI->getSubTopicData(
                                    $id, 'movie', 'videos'
                                );

/*
 *  OVERVIEW
 */
$overview_release   = '';
$film_release_year = '????';
if( !empty( $film_release_date ) )
{
    $cast_release_date  = new DateTime( $film_release_date );
    $film_release_year = $cast_release_date->format( 'Y' );
    $overview_release   = "<p>Release Date:"
        . "&nbsp;{$cast_release_date->format( 'F j, Y' )}</p>";
}

$urlIMDB = !empty( $film_imdb )
    ? (string) $moviesIMDB->getTitleUrl( $film_imdb )
    : '';

$urlMovieDB = (string) $moviesAPI->getPublicUrl( $id, 'movie' );

$overview_genres = '';
if ( $ct_film_genres > 0 )
{
    $array_genres           = array();
    foreach ($film_genres as $genre )
    {
        $genre_name         = trim( (string) $genre[ 'name' ] );
        $array_genres[]     = $genre_name;
    }
    $overview_genres = '<p>' . implode( ' | ', $array_genres ) . '</p>';
}

$overview_companies = '';
if ( $ct_film_production_companies > 0 )
{
    $array_companies        = array();
    foreach ($film_production_companies as $company )
    {
        $company_name       = trim( (string) $company[ 'name' ] );
        $array_companies[]  = $company_name;
    }
    $overview_companies = '<p>' . implode( ' | ', $array_companies ) . '</p>';
}

/*
 * Additional per-page variables
 */

$subtitle .= ": {$film_title} ({$film_release_year})";

$creditFooter   = "Click the heading above to show or hide the list.";

//for Twitter sharebuttons (delimit with comma)
$hashtag = 'themoviedb,jephmann';

//  Custom (per page) meta
$meta_image         = $image_film;
$meta_description   = htmlspecialchars( $film_overview )
                    . ' | Data courtesy of TheMovieDB.com | ';
$meta_querystring   = "?id={$id}";

/*
 * Retrive credit data, to be split
 * according to Cast/Performance and Crew/Production
 */
$credits    = (array) $moviesAPI->getSubTopicData(
                $id, 'movie', 'credits'
            );
