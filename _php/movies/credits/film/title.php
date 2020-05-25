<?php

/*
 * Retrieve data for film
 */
$topic = 'movie';            // url requires 'movie'; its data becomes 'film'

// parent data
$title                      = (array) $moviesAPI->getSubTopicData(
                                $id, $topic, 'title'
                            );
$film_homepage              = trim( (string) $title[ 'homepage'] );
$film_imdb                  = trim( (string) $title[ 'imdb_id' ] );
$film_title_original        = trim( (string) $title[ 'original_title' ] );
$film_overview              = trim( (string) $title[ 'overview' ] );
$film_poster_path           = trim( (string) $title[ 'poster_path' ] );
$film_release_date          = trim( (string) $title[ 'release_date' ] );
$film_runtime               = trim( (string) $title[ 'runtime' ] );
$film_tagline               = trim( (string) $title[ 'tagline' ] );
$film_title                 = trim( (string) $title[ 'title' ] );
$genres                     = (array) $title[ 'genres' ];
$production_companies       = (array) $title[ 'production_companies' ];
$production_countries       = (array) $title[ 'production_countries' ];

// alternate titles
$titles = (array) $moviesAPI->getSubTopicData( $id, $topic, 'titles' )['titles'];

// main image
$image_film = empty( $film_poster_path )
            ? "{$path}_images/no_pic.jpg"
            : (string) $moviesAPI->urlImages( $film_poster_path )[ 'gallery' ];

// gallery images
$images         = (array) $moviesAPI->getSubTopicData( $id, $topic, 'images' );
$posters        = (array) $images[ 'posters' ];    
$backdrops      = (array) $images[ 'backdrops' ];
$ct_posters     = (int) count( $posters );
$ct_backdrops   = (int) count( $backdrops );

// urls
$urlTMDB        = (string) $moviesAPI->getPublicUrl( $id, 'movie' );
$urlIMDB        = (string) Movies::getIMDBurl( $film_imdb );
$urlBFI         = (string) Movies::getBFIurl( $film_imdb );
$urlAFI         = (string) Movies::getAFIurl( $film_imdb );
$urlWikipedia   = (string) Tools::toWikipedia( $film_title );


// videos
$videos         = (array) $moviesAPI->getSubTopicData( $id, $topic, 'videos' );

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
$list_certifications = '<p style="font-size: 1em">'
    . '<strong>Ratings / Certifications</strong>:<br />';
if (empty( $release_certifications ))
    $list_certifications .= '&nbsp;N/A';
else
    foreach ( $release_certifications as $rcKey => $rcValue )
        $list_certifications .= '<strong>'
            . $rcKey . ':</strong>&nbsp;'
            . $rcValue . '&nbsp; ';
$list_certifications .= '</p>';

$release_date = '';
$release_year = '';
if( !empty( $film_release_date ) )
{
    $cast_release_date  = new DateTime( $film_release_date );
    $release_date       = $cast_release_date->format( 'F j, Y' );
    $release_year       = $cast_release_date->format( 'Y' );
}

/*
 *  OVERVIEW
 */

// Display the values of this array in the Overview section
$overview               = array(
    'homepage'          => $film_homepage,
    'text'              => $film_overview
        ? $film_overview
        : '',
    'tagline'           => $film_tagline,
    'title'             => $film_title,
    'title_original'    => $film_title_original
        ? Movies::doForOverview( 'Original Title', $film_title_original )
        : '',
    'release'           => $release_date
        ? Movies::doForOverview( 'Release Date', $release_date )
        : '',
    'release_year'      => $release_year
        ? $release_year
        : '????',
    'runtime'           => $film_runtime
        ? Movies::doForOverview( 'Runtime', $film_runtime, FALSE )
        : '',
    'genres'            => (string) Movies::listForMovies(
        'Genres', $genres, 'name'
    ),
    'companies'         => (string) Movies::listForMovies(
        'Production Companies', $production_companies, 'name', '<br />'
    ),
    'countries'         => (string) Movies::listForMovies(
        'Production Countries', $production_countries, 'name'
    ),
    'titles'            => (string) Movies::listForMovies(
        'Alternate Titles', $titles, 'title', '<br />'
    ),
    'imdb'              => $film_imdb,
    'urlMovieDB'        => $urlTMDB,
    'urlIMDB'           => $urlIMDB,
    'urlAFI'            => $urlAFI,
    'urlBFI'            => $urlBFI,
    'urlWikipedia'      => $urlWikipedia,
    //'certifications'    => (array) $release_certifications,
    'certifications'    => (string) $list_certifications,
    'certifications_us' => (string) $release_certifications_us,
);

/*
 * Open Movie data is unique to Movie Titles
 * until they provide other kinds of data.
 * Hence, the Open Movie API class is called only here, for now.
 * Open Movie seems to provide general "summing up" movie-title data
 * (just the main names and top credits, ratings/awards, etc.)
 * which would be appropriate for a movie's "jumbotron" section,
 * stuff I don't pick up from TheMovieDB.
 * Plus the same IMDB ids are used.
 * Sometimes the Open Movie data might not match TheMovieDB;
 * this could mean that one of them supplies an errant IMDB id.
 */

$openMoviesAPI  = new ApiOpenMovieDB;    
$omdb           = $openMoviesAPI->getTitleData( $film_imdb );

$omdb_plot      = array_key_exists( 'Plot', $omdb )
                ? $openMoviesAPI->nullNA( trim( $omdb[ 'Plot' ] ) )
                : '';

$omdb_actors    = array_key_exists( 'Actors', $omdb )
                ? $openMoviesAPI->nullNA( trim( $omdb[ 'Actors' ] ) )
                : '';
$featuring      = Movies::doForOverview( 'Featuring', $omdb_actors, TRUE );

$omdb_writer    = array_key_exists( 'Writer', $omdb )
                ? $openMoviesAPI->nullNA( trim( $omdb[ 'Writer' ] ) )
                : '';
$writtenBy      = Movies::doForOverview( 'Written by', $omdb_writer, TRUE );

$omdb_director  = array_key_exists( 'Director', $omdb )
                ? $openMoviesAPI->nullNA( trim( $omdb[ 'Director' ] ) )
                : '';
$directedBy     = Movies::doForOverview( 'Directed by', $omdb_director, TRUE );

$omdb_awards    = array_key_exists( 'Awards', $omdb )
                ? $openMoviesAPI->nullNA( trim( $omdb[ 'Awards' ] ) )
                : '';
$awardsWon     = Movies::doForOverview( 'Awards', $omdb_awards, TRUE );

/*
 * Additional per-page variables
 */

$subtitle           = "{$overview[ 'title' ]} ({$overview[ 'release_year' ]}) | {$subtitle}";

$creditFooter       = "Click the heading above to show or hide the list.";

// for Twitter sharebuttons (delimit with comma)
$hashtag            = 'themoviedb,' . Tools::hashNameTitle( $overview[ 'title' ] );

// Custom (per page) meta
$meta_image         = $image_film;
$meta_description   = htmlspecialchars( $film_title )
                    . ' (' . htmlspecialchars( $release_year )
                    . ') | ' . htmlspecialchars( $film_tagline )
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

// build Overview panel
$panelOverviewOpenMovie = (string) Tools::panelOverview(
    'Overview',
    'Open Movies',
    $omdb_plot
);