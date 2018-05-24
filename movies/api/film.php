<?php
    declare( strict_types = 1 );
    $path           = '../../';
    $views          = "{$path}_views/";
    $test           = "{$path}_php/movies/api/pre/";
    $credits_film   = "{$path}_php/movies/api/credits/film/";
    $views_movies   = "{$views}movies/";
    $views_credits  = "{$views_movies}film/credits/";
    $subtitle       = 'Movies (TMDB)';

    require_once $path . '_php/autoload.php';

    $id         = (string) $_GET[ 'id' ];
    $moviesAPI  = new ApiMovieDB;
    $moviesIMDB = new IMDB;
    
    /*
     * Retrieve and Format Data
     */
    require_once $credits_film . 'title.php';
    require_once $credits_film . 'cast.php';
    require_once $credits_film . 'crew.php';
    
    /*
     *  HTML start
     */
    require_once $views . 'head.php';
    require_once $views . 'navbar.php';
    require_once $views . 'header.php';
    require_once $views . 'open-jumbotron.php';
?>
    
    <div class="col-lg-12 col-md-12 col-sm-12">
        <h2>The Movie Section: TheMovieDB Version</h2>    
    </div>

    <?php require_once $views . 'row-jumbotron.php'; ?>

    <div class="col-lg-4 col-md-4 col-sm-4">
        
        <div class="panel panel-default">
            
            <div class="panel-body">
                <?php
                    require_once $views_movies . 'film/images.php';
                ?>
            </div>
            
        </div>
        <?php require_once $views . 'share-buttons.php'; ?>
        
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
                    require_once $views_credits . 'performance.php';
                ?>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4">
                <?php
                    require_once $views_credits . 'production.php';
                ?>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4">                
                <?php
                    require_once $views_movies . 'search.php'; ?>                
            </div> 

        </div>        
    </div>

<?php
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