<?php
   
    /*
     * imdb IDs are more unique across names and titles than tmdb IDs
     * To be bound in the processes below.
     */
    $valuesAFI  = array( ':imdb' => $overview[ 'imdb' ] );
    
    // database and query classes (assuming class files are autoloaded)
    $dbAFI      = new Database;
    $qAFI       = new Queries;
    
    /*
     * AFI top 100 and top 10
     */
    
    // connect to MySQL via PDO
    $cnAFI      = $dbAFI->connect();
    $cnAFI->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );
    
    // stored procedure
    $sqlTopAFI  = "CALL sp_displayAFI('{$overview[ 'imdb' ]}')";
    $topAFIs    = $cnAFI->query($sqlTopAFI);
        
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

        // to be looped into an HTML table
        if( $topAFI[ 'entity'] === $afiEntity ) :
        $dataTopAFI = array(
            'type'      => $topAFI[ 'type' ],
            'listType'  => $topType,
            'url'       => $topAFI[ 'listurl' ],
            'entity'    => $topAFI[ 'entity' ],
            'urlFull'   => Movies::getAFIurlList( $topAFI[ 'listurl' ] ),
            'title'     => $topAFI[ 'title' ],
            'subtitle'  => $topAFI[ 'subtitle' ],
            'year'      => $topAFI[ 'year' ],
            'rank'      => $topAFI[ 'rank' ],
            'text'      => $topAFI[ 'text' ],
        );
        array_push( $rowTopAFI, $dataTopAFI );
        endif;
    }
    
    // disconnect
    $cnAFI = NULL;
    
    /*
     * AFI Life Achievement Awards
     */
    
    // connect to MySQL via PDO
    $cnAFILife      = $dbAFI->connect();
    $cnAFILife->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );
    
    // stored procedure
    $sqlLifeAFI = "CALL sp_displayAFI_Lifetime('{$overview[ 'imdb' ]}')";
    $lifeAFIs   = $cnAFILife->query($sqlLifeAFI);
    
    $rowLifeAFI = array();
    foreach( $lifeAFIs as $lifeAFI )
    {
        $dataLifeAFI = array(
            'url'   => Movies::getAFIurlLife( $lifeAFI[ 'url' ] ),
            'year'  => $lifeAFI[ 'year' ],
        );
        array_push( $rowLifeAFI, $dataLifeAFI );
    }
    
    // disconnect
    $cnAFILife = NULL;
    