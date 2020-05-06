<?php

/*
 * Retrieve data for tv
 */
$topic = 'tv';

// parent data
$title                  = (array) $moviesAPI->getSubTopicData(
                            $id, $topic, 'title'
                        );
$tv_first_air_date      = trim( (string) $title[ 'first_air_date' ] );
$tv_homepage            = trim( (string) $title[ 'homepage'] );
$tv_last_air_date       = trim( (string) $title[ 'last_air_date' ] );
$tv_title               = trim( (string) $title[ 'name' ] );
$tv_original_name       = trim( (string) $title[ 'original_name' ] );
$tv_overview            = trim( (string) $title[ 'overview' ] );
$tv_poster_path         = trim( (string) $title[ 'poster_path' ] );
$created_by             = (array) $title[ 'created_by' ];
$ct_created_by          = (int) count( $created_by );
$genres                 = (array) $title[ 'genres' ];
$origin_country         = (array) $title[ 'origin_country' ];
$ct_origin_countries    = (int) count( $origin_country );
$production_companies   = (array) $title[ 'production_companies' ];
$tv_ct_episodes         = (int) $title[ 'number_of_episodes' ];
$tv_ct_seasons          = (int) $title[ 'number_of_seasons' ];
$tv_tagline             = ''; // *
$tv_imdb                = ''; // *
// * -- yet to find related index in TheMovieDB

// alternate titles
$titles = (array) $moviesAPI->getSubTopicData( $id, $topic, 'titles' )['results'];

// main image
$image_tv   = empty( $tv_poster_path )
            ? "{$path}_images/no_pic.jpg"
            : (string) $moviesAPI->urlImages( $tv_poster_path )[ 'gallery' ];

// gallery images
$images = (array) $moviesAPI->getSubTopicData( $id, $topic, 'images' );
$posters        = (array) $images[ 'posters' ];    
$backdrops      = (array) $images[ 'backdrops' ];
$ct_posters     = (int) count( $posters );
$ct_backdrops   = (int) count( $backdrops );

// videos
$videos = (array) $moviesAPI->getSubTopicData( $id, $topic, 'videos' );

// countries
$countries = '';
if( $ct_origin_countries > 0 )
{
    sort( $origin_country );
    $unique_country             = array_unique( $origin_country );
    $countries                  = implode( ' | ', $unique_country );
}

// creators
$creators = '';
if( $ct_created_by > 0 )
{
    foreach( $created_by as $creator )
    {
        $creator_id             = $creator[ 'id' ];
        $creator_name           = $creator[ 'name' ];
        $creators .= "<a href=\"name.php?id={$creator_id}\">"
            . "{$creator_name}"
            . "</a><br />";
    };
}

// dates
$release_date = '';
$release_year = '';
if( !empty( $tv_first_air_date ) )
{
    $cast_release_date  = new DateTime( $tv_first_air_date );
    $release_date       = $cast_release_date->format( 'F j, Y' );
    $release_year       = $cast_release_date->format( 'Y' );
}

$cancel_date = '';
$cancel_year = '';
if( !empty( $tv_last_air_date ) )
{
    $cast_cancel_date   = new DateTime( $tv_last_air_date );
    $cancel_date        = $cast_cancel_date->format( 'F j, Y' );
    $cancel_year        = $cast_cancel_date->format( 'Y' );
}        

$release_cancel              = NULL;
if ( $release_year and $cancel_year )
{
   $release_cancel = "{$release_year}-{$cancel_year}"; 
}
elseif ( $release_year and empty($cancel_year) )
{
   $release_cancel = "r. {$release_year}"; 
}
elseif ( empty( $release_year ) and $cancel_year )
{
   $release_cancel = "c. {$cancel_year}"; 
}
// if string exists, surround string with parentheses for display
if ( $release_cancel )
{
    $release_cancel = "({$release_cancel})";
}

/*
 *  OVERVIEW
 */

// Display the values of this array in the Overview section
$overview               = array(
    'homepage'          => $tv_homepage,
    'text'              => $tv_overview
        ? $tv_overview
        : '',
    'tagline'           => $tv_tagline,
    'title'             => $tv_title,
    'title_original'    => $tv_original_name
        ? Tools::doForOverview( 'Original Title', $tv_original_name )
        : '',  
    'release'           => $release_date
        ? Tools::doForOverview( 'Premiere', $release_date )
        : '',
    'release_year'      => $release_year ? $release_year : '????',
    'cancel'            => $cancel_date
        ? Tools::doForOverview( 'Finale', $cancel_date )
        : '',
    'cancel_year'       => $cancel_year ? $cancel_year : '????',
    'release_cancel'    => $release_cancel,
    'creators'          => $creators
        ? Tools::doForOverview( 'Creators', $creators )
        : '',
    'ct_episodes'       => $tv_ct_episodes > 0
        ? Tools::doForOverview( '# of Episodes', $tv_ct_episodes, FALSE )
        : '',
    'ct_seasons'        => $tv_ct_seasons > 0
        ? Tools::doForOverview( '# of Seasons', $tv_ct_seasons, FALSE )
        : '',
    'genres'            => (string) Tools::listForMovies(
            'Genres', $genres, 'name'
            ),
    'companies'         => (string) Tools::listForMovies(
            'Production Companies', $production_companies, 'name', '<br />'
            ),
    'countries'         => $countries
        ? Tools::doForOverview( 'Countries', $countries )
        : '',
    'titles'            => (string) Tools::listForMovies(
            'Alternate Titles', $titles, 'title', '<br />'
            ),
    'urlMovieDB'        => (string) $moviesAPI->getPublicUrl( $id, 'tv' ),
    'urlWikipedia'      => (string) Tools::toWikipedia( $tv_title ),
    'urlBFI'            => '', // populated via MySQL where applicable
    'urlIMDB'           => ( $tv_imdb )
        ? (string) $moviesIMDB->getTitleUrl( $tv_imdb )
        : ''
);

/*
 * Additional per-page variables
 */

$subtitle           = "{$overview[ 'title' ]} ({$overview[ 'release_year' ]}) | {$subtitle}";

$creditFooter       = "Click the heading above to show or hide the list.";

// for Twitter sharebuttons (delimit with comma)
$hashtag            = 'themoviedb,' . Tools::hashNameTitle( $overview[ 'title' ] );

// Custom (per page) meta
$meta_image         = $image_tv;
$meta_description   = htmlspecialchars( $tv_title )
                    . ' (' . htmlspecialchars( $release_year )
                    . ') | ' . htmlspecialchars( $tv_tagline )
                    . ' | Data courtesy of TheMovieDB.com | ';
$meta_querystring   = "?id={$id}";

/*
 * Retrive credit data, to be split
 * according to Cast/Performance and Crew/Production
 */
$credits = (array) $moviesAPI->getSubTopicData( $id, $topic, 'credits' );

// build Overview panel
$panelOverview = (string) Tools::panelOverview(
    'Overview',
    'TheMovieDB',
    $overview[ 'text' ]
);