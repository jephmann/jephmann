<?php
    /*
     * For now I am using the mail() function at its most basic,
     * "as is" for the live webhost.
     * (This may not work in localhost.)
     */

    class Outgoing
    {

        /*
         * properties
         */
        
        protected $me = array(
            'name'      => "Jeffrey Hartmann",
            'mail'      => "jephmann@gmail.com"
        );
        protected $confirm = array(
            'subject'   => "Email Confirmation from jephmann",
            'body'      => "Simply confirming your email message, re:<br />{}<br />Thanks!"
        );
    
        /*
         * methods
         */
    
        private function mailHeaders(
            bool $html,
            string $fromName,
            string $fromMail,
            string $toName,
            string $toMail            
        ) : string
        {
            // One sender is assumed always
            $arr[] = "From: {$fromName} <{$fromMail}>";
            // One recipient is assumed for this function
            $arr[] = "To: {$toName} <{$toMail}";
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

        private function compose_HTML(
            string $fromName,
            string $fromMail,
            string $subject,
            string $body
        ) : string
        {
            // TODO: Shop for templates
            $html   = "<html>"
                . "<head>"
                . "<title>jephmann: {$subject}</title>"
                . "</head>"
                . "<body>"
                . "<table>"
                . "<tr><td>From:</td><td>{$fromName}<br />{$fromMail}</td></tr>"
                . "<tr><td>Subject:</td><td>{$subject}</td></tr>"
                . "</table>"
                . "<div>"
                . "<p>{$body}</p>"
                . "</div>"
                . "</body>"
                . "</html>";

            return $html;
        }
        
        public function send_stuff(
                bool $html,
                string $fromName,
                string $fromMail,
                string $toName,
                string $toMail,
                string $subject,
                string $body                
        ) : bool
        {
            $message = $this->compose_HTML($fromName, $fromMail, $subject, $body);
            $headers = $this->mailHeaders($html, $fromName, $fromMail, $toName, $toMail);
            $result = mail( $toMail, $subject, $message, $headers );
            return $result;
        }
    }    

    $eContact = (bool) $Outgoing::send_stuff(
        TRUE,
        $post_contactName,
        $post_contactEmail,
        $Outgoing::me['name'],
        $Outgoing::me['mail'],
        $post_contactSubject,
        $post_contactBody
    );
    $resultContact = $eContact ? "Sent" : "Failed";

    $eConfirm = (bool) $Outgoing::send_stuff(
        TRUE,
        $Outgoing::me['name'],
        $Outgoing::me['mail'],
        $post_contactName,
        $post_contactEmail,
        $Outgoing::confirm['subject'],
        $Outgoing::confirm['body']
    );
    $resultConfirm = $eConfirm ? "Arriving" : "Failed";
    
    $resultMail = "<p>"
        . "Contact Mail {$resultContact}"
        . "<br />Confirmation Mail {$resultConfirm}"
        . "</p>";
    echo $resultMail;