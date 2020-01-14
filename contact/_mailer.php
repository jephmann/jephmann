<?php
        /*
         * PHPMailer() version, to be completed
         */

        function mailResult( object $mail ) : string
        {
            $result = "Message has been sent";
            if( !$mail->Send() )
            {
                $result =  "Message could not be sent.<br />{$mail->ErrorInfo}";
                //exit;            
            }
            return $result;
        }
        
        $myMail = new PHPMailer();
        /*
        $myMail->IsSMTP();
        $myMail->Host       = "TBD";
        $myMail->SMTPDebug  = 2;
        $myMail->SMTPAuth   = TRUE;
        $myMail->SMTPSecure = "ssl";
        $myMail->Port       = 465;
        $myMail->Username   = "TBD";
        $myMail->Password   = "TBD"; 
         */
        
        $myMail->SetFrom(
            $post_contactEmail,
            $post_contactName
        );
        $myMail->AddReplyTo(
            $post_contactEmail,
            $post_contactName
        );
        $myMail->AddAddress( $toMail, $toName );
        $myMail->Subject    = $post_contactSubject;
        $myMail->MsgHTML( $html_message );        
        $myMail->WordWrap   = 50;
        
        $eMessage        = "<p>{mailResult( $myMail )}</p>";