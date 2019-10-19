<?php
    declare( strict_types = 1 );
    // Session Variables
    session_start();
    $_SESSION['Contact']['Success'] = FALSE;
    // Page Variables
    $path                   = '../';
    $views                  = "{$path}_views/";
    $views_movies           = "{$views}movies/";
    $php_movies             = "{$path}_php/movies/";
    $test                   = "{$php_movies}pre/";
    $credits_person         = "{$php_movies}credits/person/";
    $credits_person_cast    = "{$credits_person}cast/";
    $credits_person_crew    = "{$credits_person}crew/";
    $views_name             = "{$views_movies}name/";
    $views_performance      = "{$views_name}performance/";
    $views_production       = "{$views_name}production/";
    $subtitle               = 'Movies';
    // set up future Adult toggling
    $allow_adult            = FALSE;

    require_once $path . '_php/autoload1.php';

    $id                     = (string) $_GET[ 'id' ];
    $moviesAPI              = new ApiMovieDB;
    $moviesIMDB             = new IMDB;
    
    /*
     * Retrieve Data
     */    
    require_once $credits_person . 'name.php';
    require_once $credits_person_cast . 'film.php';
    require_once $credits_person_crew . 'film.php';
    require_once $credits_person_cast . 'tv.php';
    require_once $credits_person_crew . 'tv.php';
    
    /*
     *  HTML start
     */
    require_once $views . 'head.php';
    require_once $views . 'navbar.php';
    require_once $views . 'header.php';
    require_once $views . 'open-jumbotron.php';
?>
    
    <div class="col-lg-12 col-md-12 col-sm-12">
        <h2 style="border-bottom: 1px silver dotted; padding-bottom: 6px;"><?php
            echo "{$overview[ 'name' ]} {$overview[ 'born_died' ]}";
        ?></h2>    
    </div>
    
    <div class="col-lg-4 col-md-4 col-sm-4">
        
        <div class="panel panel-default">
                      
            <div class="panel-body">
                <?php
                    require_once $views_name . 'images.php';
                ?>
            </div>
            
        </div>
        <?php require_once $views . 'share-buttons.php'; ?>
        
    </div>

    <div class="col-lg-8 col-md-8 col-sm-8">
        <?php
            require_once $views_name . 'biography.php';
        ?>
    </div>

    <?php require_once $views . 'close-jumbotron.php'; ?>

    <div class="container">
        <div class="row">            

            <div class="col-lg-4 col-md-4 col-sm-4">
                <?php
                    echo $creditsPerformancesFilm;
                    //require_once $test . 'name/cast.php';
                    echo $creditsPerformancesTV;
                    //require_once $test . 'name/cast_tv.php';
                ?>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4">
                <?php
                    echo $creditsProductionFilm;
                    //require_once $test . 'name/crew.php';
                    echo $creditsProductionTV;
                    //require_once $test . 'name/crew_tv.php';
                ?>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4">                
                <?php
                    require_once $views_movies . 'search.php';
                ?>                
            </div>

        </div>        
    </div>

<?php
    require_once $views . 'footer.php';
    require_once $views . 'load/jquery.php';
    require_once $views . 'load/bootstrap.php';                    
    if( !empty( $name_profile_path ) )
    {
        if( $ct_profiles > 0 )
        {                    
            require_once $views . 'load/galleria.php';        
        }    
    }
    require_once $views . 'load/google-analytics.php';
    require_once $views . 'foot.php';    
    /*
     *  HTML end
     */