<?php

    // base AFI url    
    $urlAFI     = 'https://www.afi.com/';
    
    /*
     * imdb IDs are more unique across names and titles than tmdb IDs
     * To be bound in the processes below.
     */
    $valuesAFI  = array( ':imdb' => $overview[ 'imdb' ] );
    
    // database and query classes (assuming class files are autoloaded)
    $dbAFI      = new Database;
    $qAFI       = new Queries;
    
    // connect to MySQL via PDO
    $cnAFI      = $dbAFI->connect();
    $cnAFI->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );
    
    /*
     * AFI top 100 and top 10
     */
    $joinAFI    = $qAFI->tableJoin( 'i',
        'afilists', 'id', 'afimovies', 'id_afilist'
        );
    $sortAFI    = 'year ASC, title ASC, rank ASC';
    
    $sqlTopAFI  = $qAFI->readSome( $joinAFI, array( 'imdb' ), $sortAFI );
    $topAFIs    = $cnAFI->prepare( $sqlTopAFI );
    $topAFIs->execute( $valuesAFI );
        
    $rowTopAFI  = array();
    foreach( $topAFIs as $topAFI )
    {            
        switch( $topAFI[ 'type' ] )
        {
            case '100':
                $topType = "100 Years";
                break;
            case '10':
                $topType = "Top 10";
                break;
        }

        $topURL = "{$urlAFI}{$topAFI[ 'url' ]}/";

        // to be looped into an HTML table
        $dataTopAFI = array(
            'type'      => $topAFI[ 'type' ],
            'listType'  => $topType,
            'url'       => $topAFI[ 'url' ],
            'urlFull'   => $topURL,
            'title'     => $topAFI[ 'title' ],
            'subtitle'  => $topAFI[ 'subtitle' ],
            'year'      => $topAFI[ 'year' ],
            'rank'      => $topAFI[ 'rank' ],
            'text'      => $topAFI[ 'text' ],
        );
        array_push( $rowTopAFI, $dataTopAFI );
    }
    
    /*
     * AFI Life Achievement Awards
     */
    // base AFI/LAA url
    $urlLifeAFI = "{$urlAFI}laa/";
    
    $sqlLifeAFI = $qAFI->readSome( 'afilife', array( 'imdb' ) );
    $lifeAFIs   = $cnAFI->prepare( $sqlLifeAFI );
    $lifeAFIs->execute( $valuesAFI );
    
    $rowLifeAFI = array();
    foreach( $lifeAFIs as $lifeAFI )
    {
        $dataLifeAFI = array(
            'url'   => "{$urlLifeAFI}{$lifeAFI[ 'url' ]}/",
            'year'  => $lifeAFI[ 'year' ],
        );
        array_push( $rowLifeAFI, $dataLifeAFI );
    }
    
    // disconnect
    $cnAFI = NULL;
    