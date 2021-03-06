<?php
    declare( strict_types = 1 );
    // Session Variables
    session_start();
    $_SESSION['Contact']['Success'] = FALSE;
    // Page Variables
    $path           = '../';
    $views          = "{$path}_views/";
    $test           = "{$path}_php/movies/pre/";
    $search         = "{$path}_php/movies/search/";
    $views_search   = "{$views}movies/search/";
    $subtitle       = 'Movies';
    // set up future Adult toggling
    $allow_adult    = FALSE;

    // autoload class files
    require_once $path . '_php/autoload1.php';
    
    /*
     * initialize variables for "if isset POST search"
     */
    $forQuery               = '';
    $query                  = '';
    // film
    $film_response          = "To see Films,"
            . " please enter a term in The Search Form.";
    $film_results           = '';
    $ct_films               = 0;
    // tv
    $tv_response            = "To see TV Shows,"
            . " please enter a term in The Search Form.";
    $tv_results             = '';
    $ct_tv                  = 0;
    // person
    $person_response        = "To see People,"
            . " please enter a term in The Search Form.";
    $person_results         = '';
    $ct_people              = 0;
    
    // for the search url
    $include_adult          = ( $allow_adult )
                            ? 'true'
                            : 'false';   
    
    //$include_adult_checked  = '';

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

        // create object for MovieDB
        $moviesAPI = new ApiMovieDB;
        
        // show results (if any)
        require_once $search . 'film.php';
        require_once $search . 'tv.php';        
        require_once $search . 'person.php';
    }

    /*
     *  Custom (per page) meta
     */
    $meta_image         = 'http://jephmann.com/_images/me201708.jpg';
    $meta_description   = 'Data courtesy of TheMovieDB.com | ';
    $meta_querystring   = (string) NULL;
    /*
     *  HTML start
     */
    require_once $views . 'head.php';
    require_once $views . 'navbar.php';
    require_once $views . 'header.php';
    require_once $views . 'open-jumbotron.php';    
?>
<div class="container">
    
    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12">
            <h2>
                The Movie Section
            </h2>    
        </div>

    </div>

    <div class="row">

        <div class="col-lg-4 col-md-4 col-sm-4">
            <p>
                In the Search Form, simply type all or part of a person's name or a
                movie's title and click the Search button.
            </p>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4">
            <p>
                Results may appear below among people's names and/or
                movie titles and/or television titles.
            </p>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4">
            <p>
                If you see a result that
                you like, click on its link for its details.
            </p>
        </div>

    </div>
    
</div>
                
<?php require_once $views . 'close-jumbotron.php'; ?>
    
<div class="container">
    <div class="row">

        <div class="col-lg-3 col-md-3 col-sm-3">
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6">        
            <?php
                require_once $views_search . 'name.php';
                require_once $views_search . 'film.php';
                require_once $views_search . 'tv.php';
                require_once $views . 'movies/search.php';
            ?>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-3">
        </div>

    </div>    
</div>

<?php
    require_once $views . 'movies/ankle.php';
    require_once $views . 'footer.php';
    require_once $views . 'load/jquery.php';
    require_once $views . 'load/bootstrap.php';
    require_once $views . 'load/google-analytics.php';
    require_once $views . 'foot.php';    
    /*
     *  HTML end
     */