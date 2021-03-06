<?php
    declare( strict_types = 1 );
    // Session Variables
    session_start();
    $_SESSION['Contact']['Success'] = FALSE;
    // Page Variables
    $path           = '../';
    $views          = "{$path}_views/";
    $php_movies     = "{$path}_php/movies/";
    $test           = "{$php_movies}pre/";
    $credits_film   = "{$php_movies}credits/film/";
    $afi_data       = "{$php_movies}afi/lists.php";
    $bfi_data       = "{$php_movies}bfi/lists.php";
    $views_movies   = "{$views}movies/";
    $views_credits  = "{$views_movies}film/credits/";
    $subtitle       = 'Movies';
    $afiEntity      = 'F';
    // set up future Adult toggling
    $allow_adult    = FALSE;

    // autoload class files
    require_once $path . '_php/autoload1.php';

    $id         = (string) $_GET[ 'id' ];
    $moviesAPI  = new ApiMovieDB;
    
    /*
     * Retrieve and Format Data
     */
    require_once $credits_film . 'title.php';
    require_once $credits_film . 'cast.php';
    require_once $credits_film . 'crew.php';
    require_once $afi_data;
    require_once $bfi_data;
    
    /*
     *  HTML start
     */
    require_once $views . 'head.php';
    require_once $views . 'navbar.php';
    require_once $views . 'header.php';
    require_once $views . 'open-jumbotron.php';
?>
    
    <div class="col-lg-12 col-md-12 col-sm-12">
        <h2 style="border-bottom: 1px silver dotted; padding-bottom: 6px;">
            <em><?php echo $overview[ 'title' ]; ?></em>
            (<?php echo $overview[ 'release_year' ]; ?>)
            [<?php echo $overview[ 'certifications_us' ]; ?>]
        </h2>    
    </div>

    <?php require_once $views . 'row-jumbotron.php'; ?>

    <div class="col-lg-4 col-md-4 col-sm-4">

        <div class="panel panel-default">

            <div class="panel-body"><?php
                require_once $views . 'share-buttons.php';
                require_once $views_movies . 'film/images.php';
            ?></div>

        </div>

    </div>

    <div class="col-lg-8 col-md-8 col-sm-8">
        <?php
            require_once $views_movies . 'film/overview.php';
        ?>
    </div>

    <?php require_once $views . 'close-jumbotron.php'; ?>

    <div class="container">
        <div class="row">

            <div class="col-lg-4 col-md-4 col-sm-4">
        
                <?php
                    // begin bottom omdb section
                    require_once $views_movies . 'omdbRatings.php';
                    // end bottom omdb section    
                    require_once $views_movies . 'afiTable.php';   
                    require_once $views_movies . 'bfiTable.php';
                ?>
                
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4">
                <?php
                    echo $creditsPerformers;
                    //require_once $test . 'cast.php';
                ?>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4">
                <?php
                    echo $creditsProduction;
                    //require_once $test . 'crew.php';
                ?>
            </div>

        </div>        
    </div>

<?php
    require_once $views . 'movies/ankle.php';
    require_once $views . 'footer.php';
    require_once $views . 'load/jquery.php';
    require_once $views . 'load/bootstrap.php';
    if( !empty( $film_poster_path ) )
    {
        if( $ct_posters > 0 or $ct_backdrops > 0 )
        {                    
            require_once $views . 'load/galleria.php';        
        }    
    }
    require_once $views . 'load/google-analytics.php';
    require_once $views . 'foot.php';    
    /*
     *  HTML end
     */