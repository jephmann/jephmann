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
            : (string) $moviesAPI->urlImages( $film_poster_path )[ 'gallery' ];

// gallery images
$images = (array) $moviesAPI->getSubTopicData( $id, $topic, 'images' );
$posters        = (array) $images[ 'posters' ];    
$backdrops      = (array) $images[ 'backdrops' ];
$ct_posters     = (int) count( $posters );
$ct_backdrops   = (int) count( $backdrops );

// videos
$videos = (array) $moviesAPI->getSubTopicData( $id, $topic, 'videos' );

// release info AKA "release_dates"; think versions
$release_info           = (array) $moviesAPI->getSubTopicData( $id, $topic, 'release_dates')['results'];
$release_certifications = array();
foreach( $release_info as $ri)
{    
    $ri_country = $ri[ 'iso_3166_1' ];
    $ri_dates   = $ri[ 'release_dates' ];
    $ri_certifications = array();
    if ( count( $ri_dates ) )
    {
        foreach( $ri_dates as $ri_d )
        {
            if(strlen($ri_d[ 'certification' ]) > 0)
                $ri_certifications[] = $ri_d[ 'certification' ];
        }
    }
    $ri_certifications = array_unique( $ri_certifications );
    $ri_country_certifications    = count($ri_certifications)
                        ? implode("|", $ri_certifications)
                        : '';
    if( $ri_country_certifications )
        $release_certifications[ $ri_country ] = $ri_country_certifications;
}
$release_certifications_us = array_key_exists( 'US', $release_certifications )
        ? $release_certifications[ 'US' ]
        : 'N/A';
$list_certifications = '<p style="font-size: small">'
    . '<strong>Ratings / Certifications</strong>:';
if (empty( $release_certifications ))
    $list_certifications .= '&nbsp;N/A';
else
    foreach ( $release_certifications as $rcKey => $rcValue )
        $list_certifications .= '<br /><strong>'
            . $rcKey . ':</strong>&nbsp;'
            . $rcValue;
$list_certifications .= '</p>';

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
                    : '',
    //'certifications'    => (array) $release_certifications,
    'certifications'    => (string) $list_certifications,
    'certifications_us' => (string) $release_certifications_us,
    );

if( !empty( $film_release_date ) )
{
    $cast_release_date  = new DateTime( $film_release_date );
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
$meta_image         = $image_film;
$meta_description   = htmlspecialchars( $overview[ 'text' ] )
                    . ' | Data courtesy of TheMovieDB.com | ';
$meta_querystring   = "?id={$id}";

/*
 * Retrive credit data, to be split
 * according to Cast/Performance and Crew/Production
 */
$credits = (array) $moviesAPI->getSubTopicData( $id, $topic, 'credits' );