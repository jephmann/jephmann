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
    
    $joinBFI    = $qBFI->tableJoin( 'i',
        'bfilists', 'id', 'bfimovies', 'id_bfilist'
    );
    $sortBFI    = 'year ASC, type ASC, subtype ASC, title ASC';
    $sqlBFI     = $qBFI->readSome( $joinBFI, array( 'imdb' ), $sortBFI );
    $movieLists = $cnBFI->prepare( $sqlBFI );
    $movieLists->execute( $valuesBFI );

    $rowListBFI    = array();
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
    
    // disconnect
    $cnBFI = NULL;