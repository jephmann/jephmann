<?php
    declare( strict_types = 1 );
    $path           = '../../';
    $views          = "{$path}_views/";
    $test           = "{$path}_php/movies/api/pre/";
    $search         = "{$path}_php/movies/api/search/";
    $views_search   = "{$views}movies/search/";
    $subtitle       = 'Movies: API Version';
    
    /*
     * initialize variables for "if isset POST search"
     */
    $forQuery               = '';
    $query                  = '';
    // film
    $film_response          = "To see Films,"
            . " please enter a term in The Search Form.";
    $film_results           = '';
    $ct_film                = 0;
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
    
    //$include_adult        = 'false';
    $include_adult          = 'true';
    $include_adult_checked  = '';

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
        
        require_once $search . 'film.php';
        require_once $search . 'tv.php';        
        require_once $search . 'person.php';
    }

    $searchFooter   = "In the Search form, simply type all or part of a person's
                        name or a movie's title and click the Search button.
                        If you see a result that you like, click on its link
                        for its details.";

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
    
    <div class="col-lg-12 col-md-12 col-sm-12">
        <h2>The Movie Section: TheMovieDB Version</h2>    
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4">        
        <?php 
            require_once $views_search . 'film.php'; 
            require_once $views_search . 'tv.php';    
        ?>        
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4">
        <?php 
            require_once $views_search . 'name.php';    
        ?>
    </div>
    
    <div class="col-lg-4 col-md-4 col-sm-4">
        <?php require_once $views . 'movies/search.php'; ?>
    </div>
                
<?php
    require_once $views . 'close-jumbotron.php';
    require_once $views . 'footer.php';
    require_once $views . 'load/jquery.php';
    require_once $views . 'load/bootstrap.php';
    require_once $views . 'load/google-analytics.php';
    require_once $views . 'foot.php';    
    /*
     *  HTML end
     */