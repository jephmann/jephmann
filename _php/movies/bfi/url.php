<?php
    
    // retrieve url for BFI name/title
    // ("Queries::readOne" not called for here,
    // as we're calling for a different unique column to retrieve an "id"
    // instead of using an "id" to retrieve other column(s).)
    
    // re-connect to MySQL via PDO
    $cnBFI      = $dbBFI->connect();
    $cnBFI->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );
    
    $sqlBFIid   = "SELECT id FROM bfi"
        . " WHERE imdb = '{$overview[ 'imdb' ]}'"
        . " LIMIT 1";
        
    $urlBFIid   = $cnBFI->query( $sqlBFIid )->fetchColumn();
    
    $overview[ 'urlBFI' ]   = $urlBFIid
        ? "{$urlBFI}films-tv-people/{$urlBFIid}" 
        : '';
    
    // disconnect
    $cnBFI      = NULL;