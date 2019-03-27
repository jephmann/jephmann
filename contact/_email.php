<?php
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

        $html_message = '<html>'
            . '<head>'
            . '<title>jephmann: ' . $post_contactSubject . '</title>'
            . '</head>'
            . '<body>'
            . '<table>'
            . '<tr><td>From:</td>'
            . '<td>' . $post_contactName . '<br />' . $post_contactEmail . '</td>'
            . '</tr>'
            . '<tr><td>Subject:</td>'
            . '<td>' . $post_contactSubject . '</td>'
            . '</tr>'
            . '</table>'
            . '<div><p>' . $post_contactBody . '</p></div>'
            . '</body>'
            . '</html>';
        
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
        $myMail->AddAddress(
            'jephmann@gmail.com',
            'Jeffrey Hartmann'
        );
        $myMail->Subject    = $post_contactSubject;
        $myMail->MsgHTML( $html_message );
        
        $myMail->WordWrap   = 50;
        
        $eMessage        = "<p>{mailResult( $myMail )}</p>";