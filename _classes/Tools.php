<?php 

class Tools {
    
    /*
     * methods
     */
    
    // retrieve an outside html page and convert into a string
    function getHTML( string $url ) : string
    {
	$user_agent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_4)'
            . ' AppleWebKit/537.36 (KHTML, like Gecko)'
            . ' Chrome/50.0.2661.102'
            . ' Safari/537.36';
        
        // establish cURL options
        $cOptions = array(
            CURLOPT_CONNECTTIMEOUT  => 10,      // 10 seconds
            CURLOPT_FOLLOWLOCATION  => true,
            CURLOPT_HEADER          => false,   // no need to print header in the output
            CURLOPT_RETURNTRANSFER  => true,    // allow transfer of output as a string to a variable    
            CURLOPT_URL             => $url,    
            CURLOPT_USERAGENT       => $user_agent,
        );

        // start cURL session
        $cSession       = curl_init();
        // send cURL options to the session
        curl_setopt_array( $cSession, $cOptions );
        // place output into string variable upon execution of session
        (string) $html  = curl_exec( $cSession );
        // end CURL session
        curl_close( $cSession );

        // return string
        return $html;
    }

    // Retrieve data from HTML pages by matching strings with regular expressions
    function scrapeHTML( string $url, string $regex ) : array
    {
        (string) $html = Tools::getHTML( $url );
        
        (array) $result = preg_match( $regex, $html, $matches )
            ? $matches
            : array( 'not found' );
        
        return $result;
    }
    
    // retrieve JSON data from outside APIs and parse into PHP array
    function getJsonArray( string $url ) : array
    {
        (string) $html = Tools::getHtml( $url );
        return json_decode( $html, true );
    }
    
    // Returns a string of array items delimited by ' | '
    // if the array has at least one item.
    function listForMovies(
            string $subject,
            array $array,
            string $key
            ) : string
    {
        //print_r($array);
        $result = '';
        if( count( $array ) > 0 )
        {
            $implodeArray = array();
            foreach ( $array as $a )
            {
                $string = trim( (string) $a[ $key ] );
                $implodeArray[] = $string;
            }
            sort($implodeArray);
            $result = '<p style="font-size: small"><strong>'
                    . $subject
                    . '</strong><br />'
                    . implode( ' | ', $implodeArray )
                    . '</p>';
        }    
        return $result;
    }    
    
}
