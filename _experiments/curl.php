<?php

echo "<!DOCTYPE html>\r";

require_once '../_php/autoload.php';

// gather tools
$myTools = new Tools();
$myIMDB = new IMDB();

/*
 * =============================================================================
 */

$ttID = '0085859';
$url_title = (string) $myIMDB->getTitleUrl( $ttID );
$ttHTML = (string) $myTools->getHTML( $url_title );

$rxTitle = '/h3 itemprop="name">[^>]+>([^<]+)<\//';
preg_match( $rxTitle, $ttHTML, $ttTitle );
$ttTitle = trim( (string) $ttTitle[1] );

$rxYear = '/h3 itemprop="name">[^\(]+\((\d+)\)/';
preg_match( $rxYear, $ttHTML, $ttYear );
$ttYear = (int) $ttYear[1];

$rxDirectors = '/h4[^>]+>Directed by.+?tbody>\s+(.+?)\s+<\/tbody/s';
preg_match( $rxDirectors, $ttHTML, $ttDirectors );
$ttD = trim( (string) $ttDirectors[1] );
$ttDirectors = preg_replace('/tr>\s+?<tr/', 'tr>|<tr', $ttD );
$d1 = explode( '|', $ttDirectors);
//echo '<pre>';
//print_r($d1);
//echo '</pre>';
$d2 = array();
foreach($d1 as $d)
{
    //$d = strip_tags($d, '<td>');
    $d = preg_replace('/td>\s+?<td/', 'td>|</td', $d);
    $arrayD = explode('|', $d);
    $d2[] = $arrayD;
}
//echo '<pre>';
//print_r($d2);
//echo '</pre>';
$arrayDirectors = array();
$billing = 0;
foreach($d2 as $d)
{
    preg_match( '/nm(\d+)\//', (string) $d[0], $nm );
    // omit $d[1]
    $uncredited = FALSE;
    $alias = '';
    if( array_key_exists( 2 , $d ) )
    {
        $credit = trim( str_replace(
                array( '(',')'),
                array( '',''),
                strip_tags( (string) $d[2] )
                ) );
        if ($credit === 'uncredited')
        {
            $uncredited = TRUE;
        }
        else
        {
            $alias = str_replace( 'as ', '', $credit );
        }
    }    
    $arrayDirectors[(int) $nm[1]]=array(
        'billing' => $billing,
        'tt' => (int) $ttID,
        'nm' => (int) $nm[1],
        'alias' => $alias,
        'uncredited' => (boolean) $uncredited,
    );
    $billing++;    
}
//echo '<pre>';
//print_r($arrayDirectors);
//echo '</pre>';

$rxWriters = '/h4[^>]+>Writing Credits.+?tbody>\s+(.+?)\s+<\/tbody/s';
preg_match( $rxWriters, $ttHTML, $ttWriters );

$arrayWriters = array( 'writers' => array() );
echo '<pre>';
print_r($arrayWriters);
echo '</pre>';

$arrayCast = array( 'cast' => array() );
echo '<pre>';
print_r($arrayCast);
echo '</pre>';

$arrayTitle = array(
    'tt' => (int) $ttID,
    'title' => $ttTitle,
    'year' => $ttYear,
    'directors' => $arrayDirectors,
    'writers' => array(),
    'cast' => array(),
);
echo '<pre>';
print_r($arrayTitle);
echo '</pre>';

echo "\r<h1>{$ttTitle}</h1>\r";
echo "\r<h2>{$ttYear}</h2>\r";
echo "\r<h3>Directors</h3>\r";
echo "\r<table>\r{$ttD}\r</table>\r";
echo "\r<table>\r";

echo "\r<tr style=\"background-color: silver;\">\r";
echo "\r<th>movie</th>\r";
echo "\r<th>billing</th>\r";
echo "\r<th>name</th>\r";
echo "\r<th>uncredited</th>\r";
echo "\r<th>alias</th>\r";
echo "\r</tr>\r";

foreach( $arrayTitle['directors'] as $d)
{
    echo "\r<tr style=\"background-color: whitesmoke;\">\r";
    echo "\r<td>{$d['tt']}</td>\r";
    echo "\r<td>{$d['billing']}</td>\r";
    echo "\r<td>{$d['nm']}</td>\r";
    echo "\r<td>{$d['uncredited']}</td>\r";
    echo "\r<td>{$d['alias']}</td>\r";
    echo "\r</tr>\r";
}
echo "\r</table>\r";
echo "\r<h3>Writers</h3>\r";
echo "\r<table>\r{$ttWriters[1]}\r</table>\r";
    