<?php
    /*
     * For now I am using the mail() function at its most basic,
     * "as is" for the live webhost.
     * (This may not work in localhost.)
     */

    function mailHeaders(
        bool $html,
        string $toName,
        string $toMail,
        string $fromName,
        string $fromMail            
    ) : string
    {
        // One recipient is assumed for this function
        $arr[] = "To: {$toName} <{$toMail}";
        // One sender is assumed always
        $arr[] = "From: {$fromName} <{$fromMail}>";
        // No Cc or Bcc
        
        // Required if HTML is TRUE
        if( $html )
        {
            // To send HTML mail, the Content-type header must be set
            $arr[] = 'MIME-Version: 1.0';
            $arr[] = 'Content-type: text/html; charset=iso-8859-1';        
        }

        // convert to string for the mail() function
        $result = implode( "\r\n", $arr );
        return $result;    
    }
        
    $eheaders = $mailHeaders(
        TRUE,
        $toName,
        $toMail,
        $post_contactName,
        $post_contactEmail
    );

    mail(
        $toMail,
        $post_contactSubject,
        $html_message,
        $eheaders
    );