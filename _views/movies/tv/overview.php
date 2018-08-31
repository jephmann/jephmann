<div class="col-lg-6 col-md-6 col-sm-6"><?php
    echo $overview[ 'release' ];
    echo $overview[ 'titles' ];
    echo $overview[ 'genres' ];
    echo $overview[ 'companies' ];
    $logo_title = $overview[ 'title' ];
?></div>

<div class="col-lg-6 col-md-6 col-sm-6"><?php
    if ( $overview[ 'tagline' ] ):
    ?><p class="text-warning"><em><?php
    echo $overview[ 'tagline' ];
    ?></em></p><?php
    endif;
    if ( $overview[ 'text' ] ):
    ?><p><?php
    echo $overview[ 'text' ];
    ?></p><?php
    endif;
    //require_once $views_movies . 'logo-links.php';
    require_once $views_movies . 'movie-links.php';
    ?>
</div>

<div class="col-lg-12 col-md-12 col-sm-12"><?php
    require_once $views_movies . 'videos.php';
?></div>

<?php
    // TESTS
    //require_once $test . 'title.php';
    //require_once $test . 'titles.php';
    //require_once $test . 'videos.php';