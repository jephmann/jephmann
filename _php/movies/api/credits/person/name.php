<?php

/*
 * Retrieve main data for Person/Name
 */

// name
$name                   = (array) $moviesAPI->getSubTopicData(
                            $id, 'person', 'name'
                        );
$name_name              = trim( (string) $name[ 'name' ] );
$name_profile_path      = trim( (string) $name[ 'profile_path' ] );
$name_biography         = trim( (string) $name[ 'biography' ] );
$name_place_of_birth    = trim( (string) $name[ 'place_of_birth' ] );
$name_birthday          = array_key_exists( 'birthday', $name )
                        ? trim( (string) $name[ 'birthday' ] )
                        : '';
$name_deathday          = array_key_exists( 'deathday', $name )
                        ? trim( (string) $name[ 'deathday' ] )
                        : '';
$name_imdb              = trim( (string) $name[ 'imdb_id' ] );
$name_aka               = (array) $name[ 'also_known_as' ];
$ct_name_aka            = (int) count( $name_aka );

// main image
$image_name             = empty( $name_profile_path )
                        ? "{$path}_images/no_pic.jpg"
                        : (string) $moviesAPI->urlImage( $name_profile_path );

// name images
$images                 = (array) $moviesAPI->getSubTopicData(
                            $id, 'person', 'images'
                        );
$images_profiles        = (array) $images[ 'profiles' ];
$ct_profiles            = (int) count( $images_profiles );


/*
 *  BIOGRAPHY
 */
$urlIMDB                = !empty( $name_imdb )
    ? (string) $moviesIMDB->getNameUrl( $name_imdb )
    : '';

$biography_imdb         = !empty( $urlIMDB )
    ? " Try <a target=\"_blank\" href=\"{$urlIMDB}bio\">IMDB</a> for more information."
    : " No IMDB link was provided.";
        
$biography_name         = !empty( $name_biography )
    ? preg_replace( '/\n/', '</p><p>', $name_biography )
    : "<em>TheMovieDB does not have a biography for {$name_name}.{$biography_imdb}</em>";

$biography_birthplace   = !empty( $name_place_of_birth )
    ? "<li><em>Birthplace:&nbsp;</em><strong>{$name_place_of_birth}</strong></li>"
    : '';

$biography_birthday     = NULL;
$birthyear              = NULL;
if( !empty( $name_birthday ) )
{
    $birthday           = new DateTime( $name_birthday );
    $birthdate          = (string) $birthday->format( 'F j, Y' );
    $birthyear          = (int) $birthday->format( 'Y' );
    $biography_birthday = "<li><em>Born:&nbsp;</em><strong>{$birthdate}</strong></li>";
}

$biography_deathday     = NULL;
$deathyear              = NULL;
if( !empty( $name_deathday ) )
{
    $deathday           = new DateTime( $name_deathday );
    $deathdate          = (string) $deathday->format( 'F j, Y' );
    $deathyear          = (int) $deathday->format( 'Y' );
    $biography_deathday = "<li><em>Died:&nbsp;</em><strong>{$deathdate}</strong></li>";        
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

if ( $born_died )
{
    $born_died = "({$born_died})";
}
        
$biography_aka  = '';
if( $ct_name_aka > 0 )
{
    sort( $name_aka );
    $akas           = implode( ' | ', $name_aka );
    $biography_aka  = "<li><em>Alias:&nbsp;</em><strong>{$akas}</strong></li>";
}

$urlMovieDB = (string) $moviesAPI->getPublicUrl( $id, 'person' );

/*
 * Additional per-page variables
 */

$subtitle .= ": {$name_name} {$born_died}";

$creditFooter   = "Click the heading above to show or hide the list.";

//for Twitter sharebuttons (delimit with comma)
$hashtag = 'themoviedb,jephmann';

//  Custom (per page) meta
$meta_image         = $image_name;
$meta_description   = htmlspecialchars( $name_biography )
                    . ' | Data courtesy of TheMovieDB.com | ';
$meta_querystring   = "?id={$id}";

/*
 * Retrive credit data, to be split
 * according to Cast/Performance and Crew/Production
 */

// film credits
$film   = (array) $moviesAPI->getSubTopicData(
            $id, 'person', 'credits'
        );
// tv credits
$tv     = (array) $moviesAPI->getSubTopicData(
            $id, 'person', 'tv'
        );