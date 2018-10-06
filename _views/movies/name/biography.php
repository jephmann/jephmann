<div class="col-lg-6 col-md-6 col-sm-6">
    <?php
        echo $overview[ 'aka' ];
        echo $overview[ 'birthplace' ];
        echo $overview[ 'birthday' ];
        echo $overview[ 'deathday' ];
    ?>
</div>

<div class="col-lg-6 col-md-6 col-sm-6">
    <blockquote class="blockquote">
        <p><?php echo $overview[ 'text' ]; ?></p>
        <small>
            from TheMovieDB (and not from Jeffrey Hartmann)
        </small>
    </blockquote>
    <?php
        // "Additional Information"
        $logo_title = $name_name;
        //require_once $views_movies . 'logo-links.php';
        require_once $views_movies . 'movie-links.php';    
    ?>
</div>

<?php
    // TESTS
    //require_once $test . 'name.php';