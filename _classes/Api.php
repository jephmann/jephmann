<?php

class Api
{
    /*
     * Attributes
     */
    
    private $key = NULL;
    private $url = NULL;

    /*
     * Methods
     */
    
    public static function getHTML( string $url ) : string
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
    
    
    public static function getJsonArray( string $json_url ) : array
    {
        $json = Api::getHTML( $json_url );
        return json_decode( $json, TRUE );
    }
}