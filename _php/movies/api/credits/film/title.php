<?php

/*
 * Retrieve data for film
 */
$topic = 'movie';            // url requires 'movie'; its data becomes 'film'

// parent data
$title  = (array) $moviesAPI->getSubTopicData( $id, $topic, 'title' );
$film_title                 = trim( (string) $title[ 'title' ] );
$film_release_date          = trim( (string) $title[ 'release_date' ] );
$film_poster_path           = trim( (string) $title[ 'poster_path' ] );
$film_tagline               = trim( (string) $title[ 'tagline' ] );
$film_overview              = trim( (string) $title[ 'overview' ] );
$film_imdb                  = trim( (string) $title[ 'imdb_id' ] );
$genres                     = (array) $title[ 'genres' ];
$production_companies       = (array) $title[ 'production_companies' ];

// alternate titles
$titles = (array) $moviesAPI->getSubTopicData( $id, $topic, 'titles' )['titles'];

// main image
$image_film = empty( $film_poster_path )
            ? "{$path}_images/no_pic.jpg"
            : (string) $moviesAPI->urlImage( $film_poster_path );

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
    'title'         => $film_title,
    'text'          => $film_overview,
    'tagline'       => $film_tagline,
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
    'urlMovieDB'    => (string) $moviesAPI->getPublicUrl( $id, 'movie' ),
    'urlIMDB'       => !empty( $film_imdb )
                    ? (string) $moviesIMDB->getTitleUrl( $film_imdb )
                    : ''
    );

if( !empty( $film_release_date ) )
{
    $cast_release_date  = new DateTime( $film_release_date );
    $overview[ 'release_year' ] = $cast_release_date->format( 'Y' );
    $overview[ 'release' ]      = "<p>Release Date:"
        . "&nbsp;{$cast_release_date->format( 'F j, Y' )}</p>";
}

/*
 * Additional per-page variables
 */

$subtitle           .= ": {$overview[ 'title' ]} ({$overview[ 'release_year' ]})";

$creditFooter       = "Click the heading above to show or hide the list.";

//for Twitter sharebuttons (delimit with comma)
$hashtag            = 'themoviedb,' . preg_replace( '/[\s\W]+/', '', $overview[ 'title' ] );

//  Custom (per page) meta
$meta_image         = $image_film;
$meta_description   = htmlspecialchars( $overview[ 'text' ] )
                    . ' | Data courtesy of TheMovieDB.com | ';
$meta_querystring   = "?id={$id}";

/*
 * Retrive credit data, to be split
 * according to Cast/Performance and Crew/Production
 */
$credits = (array) $moviesAPI->getSubTopicData( $id, $topic, 'credits' );