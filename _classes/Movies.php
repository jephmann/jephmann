<?php

/**
 * Description of Movies
 * General tools, specific to Movies section
 *
 * @author User
 */
class Movies {

    /*
     * properties
     */

    // base AFI Catalog url
    public static $urlCatalogAFI    = 'https://catalog.afi.com/';
    // base AFI url
    public static $urlAFI           = 'https://www.afi.com/';
    // base BFI url
    public static $urlBFI           = 'https://www.bfi.org.uk/';
    // base IMDB url
    public static $urlIMDB          = 'http://www.imdb.com/';

    /*
     * methods
     */
    
    public function getAFIurl(string $imdb): string {
        // retrieve value(s) from database
        $db         = new Database;
        $cn         = $db->connect();
        $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql        = "SELECT afi, url_type, url FROM afi WHERE imdb = '{$imdb}' LIMIT 1";        
        $afi        = $cn->query($sql)->fetch();
        $afi_id     = $afi[ 'afi' ];
        $afi_type   = $afi[ 'url_type' ];
        $afi_url    = $afi[ 'url' ];
        $cn         = NULL;

        // setup url types
        $type = array(
            'F' => 'Film',
            'P' => 'Person',
        );
        
        // build url
        $url    = self::$urlCatalogAFI;
        $result = $afi_id ? "{$url}{$type[$afi_type]}/{$afi_id}-{$afi_url}" : '';

        // output
        return $result;
    }
    
    public function getAFIurlLife( $urlName ) : string
    {
        // build url
        $url    = self::$urlAFI;
        $result = $url . 'laa/' . $urlName;

        // output
        return $result;
    }
    
    public function getAFIurlList( $urlList ) : string
    {
        // build url
        $url    = self::$urlAFI;
        $result = $url . $urlList . '/';

        // output
        return $result;
    }

    public function getBFIurl( string $imdb ) : string
    {
        // retrieve value(s) from database
        $db     = new Database;
        $cn     = $db->connect();
        $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql    = "SELECT id FROM bfi WHERE imdb = '{$imdb}' LIMIT 1";
        $id     = $cn->query($sql)->fetchColumn();
        $cn     = NULL;

        // build url
        $url    = self::$urlBFI;
        $result = $id ? "{$url}films-tv-people/{$id}" : '';

        // output
        return $result;
    }
    
    public function buildEGOTtable( string $imdb ) : string
    {
        // retrieve value(s) from database
        $db     = new Database;
        $cn     = $db->connect();
        $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql    = "SELECT * FROM egot WHERE imdb = '{$imdb}' LIMIT 1";
        $egot   = $cn->query($sql)->fetch();
        $egot_imdb      = (string) $egot[ 'imdb' ];
        $egot_tmdb      = (int) $egot[ 'tmdb' ];
        $egot_emmy      = (int) $egot[ 'emmy' ];
        $egot_grammy    = (int) $egot[ 'grammy' ];
        $egot_oscar     = (int) $egot[ 'oscar' ];
        $egot_tony      = (int) $egot[ 'tony' ];
        $cn     = NULL;
        
        // build table
        $table  = "";
        if( $egot_imdb ) // a count might be better here
        {
            $table  = "\r\n<table class=\"table table-hover\">"
                . "\r\n<caption>"
                . "<h4>E*G*O*T (First Awards)</h4>"
                . "</caption>"
                . "\r\n<thead>"
                . "\r\n<tr>"
                . "<th class=\"text-center\">Emmy</th>"
                . "<th class=\"text-center\">Grammy</th>"
                . "<th class=\"text-center\">Oscar</th>"
                . "<th class=\"text-center\">Tony</th>"
                . "</tr>"
                . "\r\n</thead>"
                . "\r\n<tbody>"
                . "\r\n<tr class=\"text-center\">"
                . "<td>{$egot_emmy}</td>"
                . "<td>{$egot_grammy}</td>"
                . "<td>{$egot_oscar}</td>"
                . "<td>{$egot_tony}</td>"
                . "</tr>"
                . "\r\n</tbody>"
                . "\r\n<tfoot>"
                . "\r\n<tr>"
                . "<td colspan=\"6\">"
                . "<h6 class=\"text-center\">(EGOTs may include competitive and noncompetitive awards.)</h6>"
                . "</td>"
                . "</tr>"
                . "\r\n</tfoot>"
                . "\r\n</table>";
        }
        
        // output
        return $table;
    }
    
    public function getBFIurlList( $urlList ) : string
    {
        // build url
        $url    = self::$urlBFI;
        $result = $url . $urlList . '/';

        // output
        return $result;
    }

    public function getIMDBurl(string $imdb): string {
        // setup url types
        $type   = substr($imdb, 0, 2); // should return 'nm' or 'tt'
        
        // build url
        $url    = self::$urlIMDB;
        switch ($type) {
            case 'nm':
                $result = "{$url}name/{$imdb}/";
                break;
            case 'tt':
                $result = "{$url}title/{$imdb}/fullcredits";
                break;
            default:
                $result = "";
        }

        // output
        return $result;
    }
    
    function doForOverview(
            string $subject,
            string $data,
            bool $break = TRUE            
            ) : string
    {
        $result = '<p style="font-size: 1em;">'
            . '<strong>' . $subject . ':</strong>';
        if( $break )
            $result .= '<br />';
        else
            $result .= '&nbsp;';
        $result .= $data . '</p>';
        
        return $result;
    }
    
    // Returns a string of array items delimited by ' | '
    // if the array has at least one item.
    function listForMovies(
        string $subject,
        array $array,
        string $key,
        string $delimiter = ' | '
    ) : string
    {
        //print_r($array);
        $result = '';
        if( count( $array ) > 0 )
        {
            // create new simple array
            $newArray = array();
            // populate new array with values from original array
            foreach ( $array as $a )
            {
                $string = trim( (string) $a[ $key ] );
                $newArray[] = $string;
            }
            // sort new array
            sort( $newArray );
            // remove duplicates
            $uniqueArray = array_unique( $newArray );
            // format data
            $data = implode( $delimiter, $uniqueArray );
            // build paragraph
            $result = '<p style="font-size: 1em"><strong>'
                . $subject
                . ':</strong><br />'
                . implode( $delimiter, $uniqueArray )
                . '</p>';
            $result = Movies::doForOverview( $subject, $data );
        }    
        return $result;
    }

}
