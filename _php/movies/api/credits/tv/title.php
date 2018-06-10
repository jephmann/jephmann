<?php

/*
 * Retrieve data for tv
 */
$topic = 'tv';

// parent data
$title  = (array) $moviesAPI->getSubTopicData( $id, $topic, 'title' );
$tv_title               = trim( (string) $title[ 'name' ] );
$tv_first_air_date      = trim( (string) $title[ 'first_air_date' ] );
$tv_poster_path         = trim( (string) $title[ 'poster_path' ] );
$tv_tagline             = ''; // *
$tv_overview            = trim( (string) $title[ 'overview' ] );
$tv_imdb                = ''; // *
$genres                 = (array) $title[ 'genres' ];
$production_companies   = (array) $title[ 'production_companies' ];
// * -- yet to find related index in TheMovieDB

// alternate titles
$titles = (array) $moviesAPI->getSubTopicData( $id, $topic, 'titles' )['results'];

// main image
$image_tv   = empty( $tv_poster_path )
            ? "{$path}_images/no_pic.jpg"
            : (string) $moviesAPI->urlImage( $tv_poster_path );

// gallery images
$images = (array) $moviesAPI->getSubTopicData( $id, $topic, 'images' );
$posters        = (array) $images[ 'posters' ];    
$backdrops      = (array) $images[ 'backdrops' ];
$ct_posters     = (int) count( $posters );
$ct_backdrops   = (int) count( $backdrops );

// videos
$videos = (array) $moviesAPI->getSubTopicData( $id, $topic, 'videos' );

/*
 *  OVERVIEW
 */

// Display the values of this array in the Overview section
$overview           = array(
    'title'         => $tv_title,
    'text'          => $tv_overview,
    'tagline'       => $tv_tagline,
    'release'       => '',
    'release_year'  => '????',
    'genres'        => (string) Tools::listForMovies(
            'Genres', $genres, 'name'
            ),
    'companies'     => (string) Tools::listForMovies(
            'Production Companies', $production_companies, 'name'
            ),
    'titles'        => (string) Tools::listForMovies(
            'Alternate Titles', $titles, 'title'
            ),
    'urlMovieDB'    => (string) $moviesAPI->getPublicUrl( $id, 'tv' ),
    'urlIMDB'       => !empty( $tv_imdb )
                    ? (string) $moviesIMDB->getTitleUrl( $tv_imdb )
                    : ''
    );

if( !empty( $tv_first_air_date ) )
{
    $cast_release_date  = new DateTime( $tv_first_air_date );
    $overview[ 'release_year' ] = $cast_release_date->format( 'Y' );
    $overview[ 'release' ]      = '<p style="font-size: small;">'
        . '<strong>Release Date:</strong><br />'
        . $cast_release_date->format( 'F j, Y' )
        . '</p>';
}

/*
 * Additional per-page variables
 */

$subtitle           .= ": {$overview[ 'title' ]} ({$overview[ 'release_year' ]})";

$creditFooter       = "Click the heading above to show or hide the list.";

//for Twitter sharebuttons (delimit with comma)
$hashtag            = 'themoviedb,' . preg_replace( '/[\s\W]+/', '', $overview[ 'title' ] );

//  Custom (per page) meta
$meta_image         = $image_tv;
$meta_description   = htmlspecialchars( $overview[ 'text' ] )
                    . ' | Data courtesy of TheMovieDB.com | ';
$meta_querystring   = "?id={$id}";

/*
 * Retrive credit data, to be split
 * according to Cast/Performance and Crew/Production
 */
$credits = (array) $moviesAPI->getSubTopicData( $id, $topic, 'credits' );