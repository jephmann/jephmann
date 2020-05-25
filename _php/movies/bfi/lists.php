<?php   
    /*
     * imdb IDs are more unique across names and titles than tmdb IDs
     * To be bound in the processes below.
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
                ? Movies::getBFIurlList( $mlist['url'] )                   
                : Movies::$urlBFI;

        $titleList      = "{$mlistType} {$mlist[ 'title' ]}";

        // to be looped into an HTML table
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