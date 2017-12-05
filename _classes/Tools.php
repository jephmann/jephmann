<?php 

class Tools {
    
    /*
     * methods
     */
    
    function getHTML( string $url ) : string
    {
	$ch = curl_init();

	$user_agent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_4)'
            . ' AppleWebKit/537.36 (KHTML, like Gecko)'
            . ' Chrome/50.0.2661.102'
            . ' Safari/537.36';

	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_USERAGENT, $user_agent );
	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );

	$data = (string) curl_exec( $ch );

	curl_close( $ch );

	return $data;
    }
    
    function getJsonArray( string $url ) : array
    {
        $html = Tools::getHtml( $url );
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
