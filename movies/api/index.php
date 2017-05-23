<?php
    declare( strict_types = 1 );
    $path       = '../../';
    $subtitle   = 'Movies: API Version';

$responseName           = "No results for Name yet.";
$responseTitle          = "No results for Title yet.";
$resultsName            = '';
$resultsTitle           = '';
$forQuery               = '';
    
// initialize variables for "if isset POST search"
$query                  = '';
//$include_adult        = 'false';
$include_adult          = 'true';
$include_adult_checked  = '';
$ctMovies               = 0;
$ctPersons              = 0;

// process submitted data
if ( isset( $_POST[ 'search' ] ) )
{
    // populate variables from form imput data
    $query      = (string) $_POST[ 'query' ];
    $forQuery   = "&nbsp;for \"{$query}\"";
    
    /*
    if ( isset( $_POST[ 'include_adult' ] ) )
    {
        $include_adult          = 'true';
        $include_adult_checked  = ' checked';
    }
     * 
     */

    // autoload class files
    require_once $path . '_php/autoload.php';
    $moviesAPI          = new ApiMovieDB;
    
    // retrieve movie data from API
    $resultsMovies      = (array) $moviesAPI->getResultsArray(
                            $query, 'movie', $include_adult
                        );
    $ctMovies           = (int) count( $resultsMovies );
    for ( $r=0; $r<$ctMovies; $r++ )
    {
        $rMovie         = (array) $resultsMovies[ $r ];
        $idtitle        = (string) $rMovie[ 'id' ];
        $rTitle         = (string) $rMovie[ 'title' ];
        $rOverView      = (string) $rMovie[ 'overview' ];
        $resultsTitle   .= '<li>'
            . '<a href="title.php?id=' 
            . $idtitle 
            . '" title="'
            . strtoupper( $rTitle ) 
            . ': ' 
            . $rOverView
            .' ..."><em>' 
            . $rTitle 
            . '</em>'
            . '</a>'
            . '</li>';            
    }    
    $responseTitle      = "Top Title Results{$forQuery}: {$ctMovies}";
    
    // retrieve person data from API
    $resultsPersons     = (array) $moviesAPI->getResultsArray(
                            $query, 'person', $include_adult
                        );
    $ctPersons          = (int) count( $resultsPersons );  
    for ( $r=0; $r<$ctPersons; $r++ )
    {
        $rPerson        = (array) $resultsPersons[ $r ];        
        $idname         = (string) $rPerson['id'];
        $rName          = (string) $rPerson[ 'name' ];
        $rKnownFor      = (array) $rPerson[ 'known_for'];
        $ctKnownFor     = (int) count( $rKnownFor );
        $knownForTitles = array();
        for( $kf=0; $kf<$ctKnownFor; $kf++ )
        {
            if( array_key_exists( 'title', $rKnownFor[ $kf ] ) )
            {
                $knownForTitles[ $kf ] = (string) $rKnownFor[ $kf ]['title'];
            }
        }
        $known_for      = (string) implode( '; ', $knownForTitles );
        $knownFor       = '';
        if( !empty( $known_for ) )
        {
            $knownFor = ', known for: ' . $known_for;
        }
        $resultsName    .= '<li>'
            . '<a href="name.php?id='
            . $idname 
            . '" title="'
            . strtoupper( $rName ) 
            . $knownFor
            .'">' 
            . $rName 
            . '</a></li>';            
    }    
    $responseName       = "Top Name Results{$forQuery}: {$ctPersons}";
}

// HTML start
require_once $path . '_views/head.php';
require_once $path . '_views/navbar.php';
require_once $path . '_views/header.php';
require_once $path . '_views/open-jumbotron.php';    
?>
    
    <div class="col-lg-12 col-md-12 col-sm-12">
        <h2>The Movie Section: TheMovieDB Version</h2>    
    </div>
    
    <div class="col-lg-4 col-md-4 col-sm-4">
        <?php require_once $path . '_views/movies/search.php'; ?>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $responseTitle; ?></h3>
            </div>
            <div class="panel-body">
                <ul><?php echo $resultsTitle; ?></ul>
                <!--
                <pre>
                    <?php print_r( $resultsMovies ); ?>
                </pre>
                -->
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $responseName; ?></h3>
            </div>
            <div class="panel-body">
                <ul><?php echo $resultsName; ?></ul>
                <!--
                <pre>
                    <?php print_r( $resultsPersons ); ?>
                </pre>
                -->
            </div>
        </div>
    </div>
                
<?php
    require_once $path . '_views/close-jumbotron.php';
    require_once $path . '_views/footer.php';
    require_once $path . '_views/load/jquery.php';
    require_once $path . '_views/load/bootstrap.php';
    require_once $path . '_views/load/google-analytics.php';
    require_once $path . '_views/foot.php';    
    // HTML end