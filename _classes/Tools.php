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
            $result = Tools::doForOverview( $subject, $data );
        }    
        return $result;
    }
    
    /*
     * TODO:
     * Move this function to ApiMovieDB class;
     * recode accordingly
     */
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
            $text           = "<p style=\"font-size: 1.2em;\">{$text}</p>";
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

}
