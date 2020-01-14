<?php

    $toName         = 'Jeffrey Hartmann'; 
    $toMail         = 'jephmann@gmail.com';
    $html_message   = '<html>'
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