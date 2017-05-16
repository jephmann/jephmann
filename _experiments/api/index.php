<?php    

    declare( strict_types = 1 );

    $path                   = '../../';
    
    $responseName           = "No results for Name yet.";
    $responseTitle          = "No results for Title yet.";
    $resultsName            = '';
    $resultsTitle           = '';
    
    // initialize variables for "if isset POST search"
    $query                  = '';
    $include_adult          = 'false';
    $include_adult_checked  = '';
    $ctMovies               = 0;    
    if ( isset( $_POST[ 'search' ] ) )
    {
        $query = (string) $_POST[ 'query' ];
        if ( isset( $_POST[ 'include_adult' ] ) )
        {
            $include_adult          = 'true';
            $include_adult_checked  = ' checked';
        }

        require_once $path . '_php/autoload.php';

        $moviesAPI = new ApiMovieDB;
        
        $search_movie       = $moviesAPI->urlSearch( $query, 'movie', $include_adult);
        $jsonSearchMovie    = Tools::getJsonArray( $search_movie );
        $resultsMovies      = $jsonSearchMovie['results'];
        $ctMovies           = count($resultsMovies);
        for ($r=0;$r<$ctMovies;$r++)
        {
            $rTitle     = (string) $resultsMovies[$r]['title'];
            $rOverView  = (string) $resultsMovies[$r]['overview'];
            $idtitle    = (string) $resultsMovies[$r]['id'];
            $resultsTitle .= '<li>'
                . '<a href="title.php?id=' 
                . $idtitle 
                . '" title="'
                . strtoupper($rTitle) 
                . ': ' 
                . $rOverView
                .' ..."><em>' 
                . $rTitle 
                . '</em>'
                . '</a>'
                . '</li>';            
        }
        $responseTitle = "{$ctMovies} Title Results<br />&nbsp;&nbsp;for \"{$query}\":";
        
        $search_person = $moviesAPI->urlSearch( $query, 'person', $include_adult);
        $htmlSearchPerson = Tools::getHtml($search_person);
        $jsonSearchPerson = json_decode($htmlSearchPerson, true);
        $resultsPerson = $jsonSearchPerson['results'];
        $ctPersons = count($resultsPerson);
        for ($r=0;$r<$ctPersons;$r++)
        {
            $rName = $resultsPerson[$r]['name'];
            $idname = (string) $resultsPerson[$r]['id'];
            $resultsName .= '<li>'
                    . '<a href="name.php?id='
                    . $idname
                    . '">' 
                    . $rName 
                    . '</a></li>';            
        }
        $responseName = "{$ctPersons} Name Results<br />&nbsp;&nbsp;for \"{$query}\":";
        
        
    }



    // HTML start
    require_once $path . '_views/head.php';
    require_once $path . '_views/navbar.php';
    require_once $path . '_views/header.php';
    require_once $path . '_views/open-jumbotron.php';
?>
        
                <div class="col-xs-4">
                    <h2>The search form</h2>
                    <form method="post">
                        <p>
                            <input type="text" name="query" value="<?php echo $query ?>" placeholder="Enter a part of a name or title." />
                            <br/>
                            <input type="checkbox" name="include_adult"<?php echo $include_adult_checked; ?> />
                            Include Adult Data
                            <br/>
                            <!--
                            <p>[_] Page. ("&page" = integer)</p>
                            <p>[]> Language e.g. "en_us". ("&language" string)</p>
                            <p><select></select> Year. ("&year" = integer)</p>
                            <p><select></select> Primary Release Year. ("&primary_release_year" = integer)</p>
                            -->
                            <button name="search" class="btn btn-primary"
                                    onclick="alert(document.getElementById('txtSearch').value)">
                                Search
                            </button>
                        </p>

                    </form>
                </div>

                <div class="col-xs-4">
                    <h2>Title Results</h2>
                    <h3><?php echo $responseTitle; ?></h3>
                    <ul><?php echo $resultsTitle; ?></ul>
                </div>

                <div class="col-xs-4">
                    <h2>Name Results</h2>
                    <h3><?php echo $responseName; ?></h3>
                    <ul><?php echo $resultsName; ?></ul>
                </div>
                
<?php
    require_once $path . '_views/close-jumbotron.php';
    require_once $path . '_views/footer.php';
    require_once $path . '_views/foot.php';    
    // HTML end