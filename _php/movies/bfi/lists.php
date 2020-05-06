<?php

    // base BFI url    
    $urlBFI     = 'https://www.bfi.org.uk/';
    
    /*
     * imdb IDs are more unique across names and titles than tmdb IDs
     * To be bound in the processes below.
     */
    $valuesBFI  = array( ':imdb' => $overview[ 'imdb' ] );
    
    // database and query classes (assuming class files are autoloaded)
    $dbBFI      = new Database;
    $qBFI       = new Queries;
    
    // connect to MySQL via PDO
    $cnBFI      = $dbBFI->connect();
    $cnBFI->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );
    
    // arrays re poll type IDs
    $aTypes     = array(
        '10'    => 'Top 10',
        '100'   => 'Top 100',
    );    
    $aSubTypes  = array(
        'C'     => 'Critics',
        'D'     => 'Directors',
    );
    // limited to not-always-every-10-years polls, no index
    $aPollYears = array(
        1952, 1962, 1972, 1982, 1992, 2002, 2012, 2014
    );
    
    // old-school triple table join, no Queries class
    $sqlListMoviesBFI   = "SELECT * FROM bfilists"
        . " INNER JOIN bfimovies ON bfilists.id = bfimovies.id_bfilist"
        . " INNER JOIN bfi ON bfimovies.id_bfi = bfi.id"
        . " WHERE bfi.imdb = '{$overview[ 'imdb' ]}'"
        . " ORDER BY year ASC, type ASC, subtype ASC, title ASC";
    $movieLists     = $cnBFI->query( $sqlListMoviesBFI );

    $rowListBFI     = array();
    foreach ($movieLists as $mlist) {

        $mlistType      = Tools::getArrayValue( $aTypes, $mlist['type'] );            
        $mlistSubType   = Tools::getArrayValue( $aSubTypes, $mlist['subtype'] );

        $urlList        = $mlist['url']
                ? "{$urlBFI}{$mlist['url']}/"                   
                : $urlBFI;

        $titleList      = "{$mlistType} {$mlist[ 'title' ]}";

        $dataListBFI        = array(
            'type'          => $mlist[ 'type' ],
            'listType'      => $mlistType,
            'subtype'       => $mlist[ 'subtype' ],
            'listSubType'   => $mlistSubType,
            'url'           => $mlist['url'],
            'urlFull'       => $urlList,
            'title'         => $mlist[ 'title' ],
            'year'          => $mlist[ 'year'],
            'rank'          => $mlist[ 'rank' ],
            'titleFull'     => $titleList,
        );
        array_push( $rowListBFI, $dataListBFI );
    }
    
    // retrieve url for BFI name/title
    // ("Queries::readOne" not called for here,
    // as we're calling for a different unique column to retrieve an "id"
    // instead of using an "id" to retrieve other column(s).)
    $sqlBFIid = "SELECT id FROM bfi"
        . " WHERE imdb = '{$overview[ 'imdb' ]}'"
        . " LIMIT 1";
    $urlBFIid = $cnBFI->query( $sqlBFIid )->fetchColumn();
    $overview[ 'urlBFI' ]   = $urlBFIid
        ? "{$urlBFI}films-tv-people/{$urlBFIid}" 
        : '';
    
    // disconnect
    $cnBFI = NULL;