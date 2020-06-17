<?php

    /*
     * re e-mail headers:
     * Host currently uses PHP 7.1 which limits headers to \r\n-delimited strings.
     * From 7.2 onward, PHP also allows header arrays.
     */

    // my copy
    $incoming               = array();
    $incoming[ 'from' ]     = $email;
    $incoming[ 'to' ]       = "Jeffrey P. Hartmann <jephmann@gmail.com>";
    $incoming[ 'subject' ]  = "jephmann | {$subject}";
    $incoming[ 'message' ]  = wordwrap( $body, 80 );
    $incoming[ 'headers' ]  = "from: {$name} <{$email}>\r\n"
                            . "reply-to: {$name} <{$email}>\r\n";
    mail(
        $incoming[ 'to' ],
        $incoming[ 'subject' ],
        $incoming[ 'message' ],
        $incoming[ 'headers' ]
    );
    
    // user's copy
    $confirmation           = "Message received!\r\n\r\n{$body}";
    $confirm                = array();
    $confirm[ 'from' ]      = "jephmann@gmail.com";
    $confirm[ 'to' ]        = "{$name} <{$email}>";
    $confirm[ 'subject' ]   = "jephmann | Confirmation ({$subject})";
    $confirm[ 'message' ]   = wordwrap( $confirmation, 80 );
    $confirm[ 'headers' ]   = "from: Jeffrey P. Hartmann <jephmann@gmail.com>\r\n"
                            . "reply-to: Jeffrey P. Hartmann <jephmann@gmail.com>\r\n";
    mail(
        $confirm[ 'to' ],
        $confirm[ 'subject' ],
        $confirm[ 'message' ],
        $confirm[ 'headers' ]
    );