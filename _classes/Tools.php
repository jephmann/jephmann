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
    
    // Returns a pop-up alert;
    // mostly for testing.
    function alertThis( string $text ) : string
    {
        return "<script type='text/javascript'>alert('{$text}');</script>";
    }
    
    /*
     * evaluate incoming string data re:
     * Required
     * Maximum Length
     * optional Regex matching
     */
    function evaluateData(
        string $field,
        string $data,
        bool $required,
        int $maxchars,
        string $regex = ''
    ) : string
    {
        $result = '';
        
        if ( $required )
            if( empty( $data ) )
                $result = "{$field}: Required.";
        elseif( $maxchars )
            if ( strlen( $data ) > $maxchars )
                $result = "{$field}: Must not exceed {$maxchars} characters.";
        elseif( $regex )
            if( !preg_match( $regex, $data ) )
                $result = "{$field}: Improperly formatted.";
                
        if ( $result )
            $result = "<li>{$result}</li>";
            
        return $result;
    }
    
    /*
     * Use primaryPanel() to create overview/biography panels;
     */
    function panelOverview(
        string $type,
        string $source,
        string $text
    ) : string
    {
        $panelOverview  = '';
        $title          = '';
        $footer         = '';
        if( strlen($text) )
        {
            $title          = "{$type} from {$source}";
            $text           = "<p style=\"font-size: 1.2em;\">{$text}</p>";
            $footer         = 'Click the heading above to show or hide the text.';
            $panelOverview  = Tools::createPanel($title, $text, $footer, TRUE, 'default');            
        }
        return $panelOverview;
    }
    
    /*
     * Use primaryPanel() to create Credits panels;
     */
    function panelCredits(
        int $count,    
        string $type,
        string $text
    ) : string
    {
        $panelCredits   = '';
        $title          = '';
        $footer         = '';
        if( $count )
        {
            $title          = "{$type}";
            $footer         = 'Click the heading above to show or hide the list.';
            $panelCredits   = Tools::createPanel($title, $text, $footer, TRUE, 'default');            
        }
        return $panelCredits;
    }
    
    /*
     * Create Bootstrap panel with optional collapsibility
     */
    function createPanel(
        string $title,
        string $text,
        string $footer,
        bool $isCollapsible,
        string $style = 'default'   // default; primary; etc.    
    ) : string
    {
        $panelTitle     = $title;
        $id             = '';
        $idBody         = '';
        $collapseClass  = '';
        if( $isCollapsible )
        {
            $id             = preg_replace( '/\s+/', '', $title );
            $panelTitle     = "<a data-toggle=\"collapse\" href=\"#{$id}\"
                title=\"Click for {$title}\">{$title}</a>
                <span class=\"caret\"></span>";
            $collapseClass  = " panel-collapse collapse in";
            $idBody         = " id=\"{$id}\"";
        }
                
        $panelHeading   = "<div class=\"panel-heading\">"
            . "<h3 class=\"panel-title\">{$panelTitle}</h3>"
            . "</div>";
        
        $panelBody      = "<div{$idBody} class=\"panel-body{$collapseClass} credits-scroll\">{$text}</div>";
        
        $panelFooter    = "<div class=\"panel-footer\">"
            . "<p style=\"font-size: 1.1em;\"></p>"
            . "</div>";
        
        $panelFooter    = ( $footer )
                        ? "<div class=\"panel-footer\">"
                            . "<p style=\"font-size: 1.1em;\">{$footer}</p>"
                            . "</div>"
                        : '';
            
        $primaryPanel   = "<div class=\"panel panel-{$style}\">{$panelHeading}{$panelBody}{$panelFooter}</div>";
        
        return $primaryPanel;
    }

    /*
     * create a URL which might open a topic's Wikipedia page
     */
    function toWikipedia( string $topic, string $lang="en" ) : string
    {
        /*
         * lang = 2-letter string denoting language Wikipedia might support (or not);
         * default = en (as in English)
         * 
         * topic = an occasionally accurate search term
         * which one might enter into a Wikipedia search form
         * 
         * Sometimes a Wikipedia page might not exist yet for a topic,
         * and sometimes Wikipedia might remove a page completely for a topic;
         * either may result in Wikipedia suggesting
         * that a user create a new page if topic not found.
         * 
         * Wikipedia might also do the following with the url:
         * post an error page
         * suggest hints on a disambiguation page
         * go to a topic page which might hint at at least one alternative
         * go directly to the exact topic page. 
         */
        
        // format topic string by replacing space characters with underscores
        $wiki_topic = preg_replace( '/\s+/', '_', trim( $topic ) );
        
        // build WikiPedia URL
        $url        = "http://{$lang}.wikipedia.org/wiki/{$wiki_topic}";
        
        // output URL    
        return $url;
    }
    
    /*
     * replace ampersands, for spaceless hashtags
     */
    function ampAnd( $string ) : string
    {
        return preg_replace( '~[&]+~', 'And', $string );
    }
    
    /*
     * and a half (replace representations of half, for spaceless hashtags)
     */
    function andAHalf( $string ) : string
    {
        /*
         * TODO: stumped re '1/2'
         */
        return preg_replace( '~[\½]+~', 'AndAHalf', $string );
    }
    
    /*
     * and a third (replace representations of third, for spaceless hashtags)
     */
    function andAThird( $string ) : string
    {
        /*
         * TODO: stumped re '1/3'
         */
        return preg_replace( '~[\⅓]+~', 'AndAThird', $string );
    }
    
    /**
    * Replace diacritical characters with natural characters
    *
    * @param $string
    * @return mixed
    * @link http://myshadowself.com/coding/php-function-to-convert-accented-characters-to-their-non-accented-equivalant/
    */
    function replaceDiacriticals( $string ) : string
    {
        $diacriticals   = array(
            'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ',
            'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ',
            'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß',
            'à', 'á', 'â', 'ã', 'ä', 'å', 'æ',
            'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ',
            'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ',
            'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą',
            'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ',
            'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě',
            'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ',
            'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı',
            'Ĳ', 'ĳ',
            'Ĵ', 'ĵ', 'Ķ', 'ķ',
            'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł',
            'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ',
            'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő',
            'Œ', 'œ',
            'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š',
            'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ',
            'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų',
            'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž',
            'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư',
            'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ',
            'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ',
            'Ǻ', 'ǻ',
            'Ǽ', 'ǽ',
            'Ǿ', 'ǿ', 'Ά', 'ά', 'Έ', 'έ', 'Ό', 'ό', 'Ώ', 'ώ', 'Ί', 'ί', 'ϊ', 'ΐ',
            'Ύ', 'ύ', 'ϋ', 'ΰ', 'Ή', 'ή' );
        $naturals       = array(
            'A', 'A', 'A', 'A', 'A', 'A', 'AE',
            'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N',
            'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's',
            'a', 'a', 'a', 'a', 'a', 'a', 'ae',
            'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n',
            'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y',
            'A', 'a', 'A', 'a', 'A', 'a',
            'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd',
            'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e',
            'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h',
            'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i',
            'IJ', 'ij',
            'J', 'j', 'K', 'k',
            'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l',
            'N', 'n', 'N', 'n', 'N', 'n', 'n',
            'O', 'o', 'O', 'o', 'O', 'o',
            'OE', 'oe',
            'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's',
            'T', 't', 'T', 't', 'T', 't',
            'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u',
            'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z',
            's', 'f', 'O', 'o', 'U', 'u',
            'A', 'a', 'I', 'i', 'O', 'o',
            'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u',
            'A', 'a',
            'AE', 'ae',
            'O', 'o', 'Α', 'α', 'Ε', 'ε', 'Ο', 'ο', 'Ω', 'ω', 'Ι', 'ι', 'ι', 'ι',
            'Υ', 'υ', 'υ', 'υ', 'Η', 'η' );
        $result         = (string) str_replace( $diacriticals, $naturals, $string );
        return $result;
    }
    
    /*
     * prepare names and titles for hashtags re sharing
     */
    function hashNameTitle( $string ) : string
    {
        $amp            = Tools::ampAnd( $string );
        $half           = Tools::andAHalf( $amp );
        $third          = Tools::andAThird( $half );
        $diacriticals   = Tools::replaceDiacriticals( $third );
        // replace $ (TODO: Refine if needed)
        $dollars        = preg_replace( '~[\$]+~', 'Dollars', $diacriticals );        
        // trim spaces
        $result         = preg_replace( '~[\s\W]+~', '', $dollars );
        // output result
        return $result;
    }
    
    /*
     * seeks a match from an indexed array
     */
    function getArrayValue ( array $array, string $index ) : string
    {
        $result = '';
        foreach( $array as $key => $value )
        {
            if( $index == $key )
            {
                $result = $value;
            }
            else
            {
                continue;
            }
            
            return $result;
        }
    }
    
    // Returns 's' if "https" version is called
    // (to be appended to this project's URLs)
    function isHttpS() : string
    {
        $result = !empty($_SERVER['HTTPS']) ? 's' : '';
        return $result;
    }    
    
}
