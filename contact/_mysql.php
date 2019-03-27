<?php
    $db     = new Database;
    $crud   = new Queries;
    try
    {        
        $jephmann       = $db->connect();    
        // set error mode to exception (could I do this in the Class?)
        $jephmann->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
        // establish our table
        $table          = 'contact';
        // establish our parameters for our query (id and date_entered omitted)
        $iParameters    = array(
            'name', 'email', 'subject', 'body'
        );
        // build parameterized INSERT statement
        $sql            = (string) $crud->create( $table, $iParameters );
        // prepare sql statement for PDO
        $insert         = $jephmann->prepare( $sql );
        // bind parameters to variables
        $insert->bindParam( ':name', $name );
        $insert->bindParam( ':email', $email );
        $insert->bindParam( ':subject', $subject );
        $insert->bindParam( ':body', $body );
        // populate variables with form data
        $name           = (string) $post_contactName;
        $email          = (string) $post_contactEmail;
        $subject        = (string) $post_contactSubject;
        $body           = (string) $post_contactBody;
        // exectue query
        $insert->execute();
        // disconnect from database
        $jephmann       = null;
        // assuming that this works, announce the good news
        $eMessage       = '';
        $_SESSION['Contact']['Success'] = "Thanks, {$post_contactName}!";
    }
    catch ( PDOException $e )
    {
        // assuming that this fails, announce the bad news
        $eMessage       = "Message could not be sent:<br />{$e->getMessage()}";
        die();
        $_SESSION['Contact']['Success'] = '';
    }
    $eMessage = "<p>{$eMessage}</p>";