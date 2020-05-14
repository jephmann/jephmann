<?php
    // base BFI url    
    $urlBFI     = 'https://www.bfi.org.uk/';
    
    /*
     * imdb IDs are more unique across names and titles than tmdb IDs
     */
    $valuesBFI  = array( ':imdb' => $overview[ 'imdb' ] );
    
    // arrays re poll type IDs
    $aTypes     = array(
        '10'    => 'Top 10',
        '100'   => 'Top 100',
    );    
    $aSubTypes  = array(
        'C'     => 'Critics',
        'D'     => 'Directors',
    );
    
    // database and query classes (assuming class files are autoloaded)
    $dbBFI      = new Database;
    $qBFI       = new Queries;
    
    // connect to MySQL via PDO
    $cnBFI      = $dbBFI->connect();
    $cnBFI->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );
    
    // stored procedure
    $sqlListMoviesBFI   = "CALL sp_displayBFI('{$overview[ 'imdb' ]}')";
    $movieLists         = $cnBFI->query($sqlListMoviesBFI);

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
    
    // disconnect
    $cnBFI = NULL;