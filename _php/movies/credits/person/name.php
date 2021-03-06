<?php

/*
 * Retrieve main data for Person/Name
 */
$topic = 'person';

// parent data
$name                   = (array) $moviesAPI->getSubTopicData(
                            $id, $topic, 'name'
                        );
$name_biography         = trim( (string) $name[ 'biography' ] );
$name_homepage          = trim( (string) $name[ 'homepage'] );
$name_imdb              = trim( (string) $name[ 'imdb_id' ] );
$name_name              = trim( (string) $name[ 'name' ] );
$name_profile_path      = trim( (string) $name[ 'profile_path' ] );
$name_place_of_birth    = array_key_exists( 'place_of_birth', $name )
                        ? trim( (string) $name[ 'place_of_birth' ] )
                        : '';
$name_birthday          = array_key_exists( 'birthday', $name )
                        ? trim( (string) $name[ 'birthday' ] )
                        : '';
$name_deathday          = array_key_exists( 'deathday', $name )
                        ? trim( (string) $name[ 'deathday' ] )
                        : '';

// alternate names
$aka                    = (array) $name[ 'also_known_as' ];
$ct_aka                 = (int) count( $aka );

// main image
$image_name             = empty( $name_profile_path )
                        ? "{$path}_images/no_pic.jpg"
                        : (string) $moviesAPI->urlImages( $name_profile_path )[ 'gallery' ];

// name images
$images                 = (array) $moviesAPI->getSubTopicData(
                            $id, $topic, 'images'
                        );
$images_profiles        = (array) $images[ 'profiles' ];
$ct_profiles            = (int) count( $images_profiles );

// urls
$urlTMDB        = (string) $moviesAPI->getPublicUrl( $id, 'person' );
$urlIMDB        = (string) Movies::getIMDBurl( $name_imdb );
$urlBFI         = (string) Movies::getBFIurl( $name_imdb );
$urlAFI         = (string) Movies::getAFIurl( $name_imdb );
$urlWikipedia   = (string) Tools::toWikipedia( $name_name );

// dates
$birthdate              = '';
$birthyear              = NULL;
if( !empty( $name_birthday ) )
{
    if( is_numeric( $name_birthday ) )
    {
        // partial date
        $birthdate  = (string) $name_birthday;
        $birthyear  = (int) $name_birthday;
    }
    else
    {
        // full date
        $birthday   = new DateTime( $name_birthday );
        $birthdate  = (string) $birthday->format( 'F j, Y' );
        $birthyear  = (int) $birthday->format( 'Y' );
    }
}

$deathdate              = '';
$deathyear              = NULL;
if( !empty( $name_deathday ) )
{
    if( is_numeric( $name_deathday ) )
    {
        // partial date
        $deathdate  = (string) $name_deathday;
        $deathyear  = (int) $name_deathday;
    }
    else
    {
        // full date
        $deathday   = new DateTime( $name_deathday );
        $deathdate  = (string) $deathday->format( 'F j, Y' );
        $deathyear  = (int) $deathday->format( 'Y' );
    }
}

$born_died              = NULL;
if ( $birthyear and $deathyear )
{
   $born_died = "{$birthyear}-{$deathyear}"; 
}
elseif ( $birthyear and empty($deathyear) )
{
   $born_died = "b. {$birthyear}"; 
}
elseif ( empty( $birthyear ) and $deathyear )
{
   $born_died = "d. {$deathyear}"; 
}
// if string exists, surround string with parentheses for display
if ( $born_died )
{
    $born_died = "({$born_died})";
} 

/*
 * GALLERIA strings
 */

$galleria = array(
    'name' => $name_name,
    'born_died' => $born_died,
    'birthplace' => $name_place_of_birth
);

/*
 *  BIOGRAPHY (aka OVERVIEW)
 */

// Display the values of this array in the Biography section
$overview           = array(
    'name'          => $name_name,
    'homepage'      => $name_homepage,
    'aka'           => '',
    'text'          => !empty( $name_biography )
                    ? preg_replace( '/\n/', '&nbsp;', $name_biography )
                    : '',
    'birthplace'    => !empty( $name_place_of_birth )
                    ? Movies::doForOverview( 'Birthplace', $name_place_of_birth )
                    : '',
    'birthday'      => $birthdate
                    ? Movies::doForOverview( 'Born', $birthdate )
                    : '',
    'deathday'      => $deathdate
                    ? Movies::doForOverview( 'Died', $deathdate )
                    : '',
    'born_died'     => $born_died,
    'imdb'          => $name_imdb,
    'urlMovieDB'    => $urlTMDB,
    'urlIMDB'       => $urlIMDB,
    'urlAFI'        => $urlAFI,
    'urlBFI'        => $urlBFI,
    'urlWikipedia'  => $urlWikipedia,
    );

if( $ct_aka > 0 )
{
    sort( $aka );
    $unique_aka         = array_unique( $aka );
    $akas               = implode( ' <br /> ', $unique_aka );
    $overview[ 'aka' ]  = Movies::doForOverview( 'Alias', $akas );
}

/*
 * Additional per-page variables
 */

$subtitle       = "{$overview[ 'name' ]} {$overview[ 'born_died' ]} | {$subtitle}";

$creditFooter   = "Click the heading above to show or hide the list.";

//for Twitter sharebuttons (delimit with comma)
$hashtag        = 'themoviedb,' . Tools::hashNameTitle( $name_name );

//  Custom (per page) meta
$meta_image         = $image_name;
$meta_description   = htmlspecialchars( $name_name )
                    . ' ' . htmlspecialchars( $born_died )
                    . ' | Data courtesy of TheMovieDB.com | ';
$meta_querystring   = "?id={$id}";

/*
 * Retrive credit data, to be split
 * according to Cast/Performance and Crew/Production
 */

// film credits
$film   = (array) $moviesAPI->getSubTopicData(
            $id, $topic, 'credits'
        );
// tv credits
$tv     = (array) $moviesAPI->getSubTopicData(
            $id, $topic, 'tv'
        );

// build Biography panel
$panelBiography = (string) Tools::panelOverview(
    'Biography',
    'TheMovieDB',
    $overview[ 'text' ]
);