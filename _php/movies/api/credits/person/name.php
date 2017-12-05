<?php

/*
 * Retrieve main data for Person/Name
 */
$topic = 'person';

// parent data
$name                   = (array) $moviesAPI->getSubTopicData(
                            $id, $topic, 'name'
                        );
$name_name              = trim( (string) $name[ 'name' ] );
$name_profile_path      = trim( (string) $name[ 'profile_path' ] );
$name_biography         = trim( (string) $name[ 'biography' ] );
$name_place_of_birth    = array_key_exists( 'place_of_birth', $name )
                        ? trim( (string) $name[ 'place_of_birth' ] )
                        : '';
$name_birthday          = array_key_exists( 'birthday', $name )
                        ? trim( (string) $name[ 'birthday' ] )
                        : '';
$name_deathday          = array_key_exists( 'deathday', $name )
                        ? trim( (string) $name[ 'deathday' ] )
                        : '';
$name_imdb              = trim( (string) $name[ 'imdb_id' ] );
$aka                    = (array) $name[ 'also_known_as' ];
$ct_aka                 = (int) count( $aka );

// main image
$image_name             = empty( $name_profile_path )
                        ? "{$path}_images/no_pic.jpg"
                        : (string) $moviesAPI->urlImage( $name_profile_path );

// name images
$images                 = (array) $moviesAPI->getSubTopicData(
                            $id, $topic, 'images'
                        );
$images_profiles        = (array) $images[ 'profiles' ];
$ct_profiles            = (int) count( $images_profiles );


/*
 *  BIOGRAPHY
 */

// Display the values of this array in the Biography section
$overview           = array(
    'name'          => $name_name,
    'aka'           => '',
    'text'          => !empty( $name_biography )
                    ? preg_replace( '/\n/', '</p><p>', $name_biography )
                    : "<em>TheMovieDB does not have a biography for {$name_name}.</em>",
    'birthplace'    => !empty( $name_place_of_birth )
                    ? "<li><em>Birthplace:&nbsp;</em><strong>{$name_place_of_birth}</strong></li>"
                    : '',
    'birthday'      => '',
    'deathday'      => '',
    'born-died'     => '',
    'urlMovieDB'    => (string) $moviesAPI->getPublicUrl( $id, $topic ),
    'urlIMDB'       => !empty( $name_imdb )
                    ? (string) $moviesIMDB->getNameUrl( $name_imdb )
                    : '',
    );

if( empty( $name_biography ) )
{    
$overview['text']         .= !empty( $name_imdb )
    ? " Try <a target=\"_blank\" href=\"{$overview[ 'urlIMDB' ]}bio\">IMDB</a> for more information."
    : " No IMDB link was provided.";
}


$birthyear              = NULL;
if( !empty( $name_birthday ) )
{
    if( is_numeric( $name_birthday ) )
    {
        // partial date
        $birthdate  = (string) $name_birthday;
        $birthyear = (int) $name_birthday;
    }
    else
    {
        // full date
        $birthday   = new DateTime( $name_birthday );
        $birthdate  = (string) $birthday->format( 'F j, Y' );
        $birthyear = (int) $birthday->format( 'Y' );
    }
    
    $overview[ 'birthday' ] = "<li>"
        . "<em>Born:&nbsp;</em>"
        . "<strong>{$birthdate}</strong>"
        . "</li>";
}

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
    
    $overview[ 'deathday' ] = "<li>"
        . "<em>Died:&nbsp;</em>"
        . "<strong>{$deathdate}</strong>"
        . "</li>";        
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
    $overview[ 'born_died' ] = $born_died;
        
if( $ct_aka > 0 )
{
    sort( $aka );
    $akas           = implode( ' | ', $aka );
    $overview[ 'aka' ]  = "<li><em>Alias:&nbsp;</em><strong>{$akas}</strong></li>";
}

//$urlMovieDB = (string) $moviesAPI->getPublicUrl( $id, $topic );

/*
 * Additional per-page variables
 */

$subtitle .= ": {$overview[ 'name' ]} {$overview[ 'born_died' ]}";

$creditFooter   = "Click the heading above to show or hide the list.";

//for Twitter sharebuttons (delimit with comma)
$hashtag = 'themoviedb,' . preg_replace('/[\s\W]+/', '', $name_name);

//  Custom (per page) meta
$meta_image         = $image_name;
$meta_description   = htmlspecialchars( $overview[ 'text' ] )
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